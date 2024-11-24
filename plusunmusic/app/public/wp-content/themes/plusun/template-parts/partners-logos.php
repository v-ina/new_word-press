<?php

/**
 * Template part for displaying partners section
 * 
 * @param array $args Contains:
 *                    - title: Section title
 *                    - partners: Array of partner objects with logo information
 */

// Ensure we have required data
if (!isset($args['title']) || !isset($args['partners']) || empty($args['partners'])) {
  return;
}

$title = $args['title'];
$partners = $args['partners'];
?>

<section class="header-darked section-full navigable bg-gradient-black pt-[66px]">
  <div class="min-h-[100vh] flex flex-col justify-center">
    <div class="w-full flex flex-col items-center justify-center mx-auto">
      <h2 class="service-title between-plus beige inline-block text-center mb-12">
        <?php echo esc_html($title); ?>
      </h2>

      <div class="partners">
        <?php for ($i = 0; $i < 3; $i++) : ?>
          <div class="partners__line <?php echo $i === 1 ? 'second-parallel' : ($i === 0 ? 'first-parallel' : 'third-parallel'); ?> flex gap-24 items-center my-14">
            <?php foreach ($partners as $partner): ?>
              <img
                src="<?php echo esc_url($partner['logo']['sizes']['large']); ?>"
                alt="<?php echo esc_attr($partner['logo']['alt'] ?? ''); ?>">
            <?php endforeach; ?>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</section>

<style>
  .partners {
    overflow: hidden;
  }

  .partners__line {
    will-change: transform;
    white-space: nowrap;
    gap: 96px !important;
  }

  .partners__line img {
    user-select: none;
    -webkit-user-drag: none;
  }

  .header-darked {
  overflow-x: hidden; /* 수평 스크롤바 제거 */
}

.partners {
  overflow: hidden; /* 기존 코드 유지 */
  position: relative; /* 애니메이션을 위한 기준점 */
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const pTag1 = document.querySelector('.first-parallel');
  const pTag2 = document.querySelector('.second-parallel');
  const pTag3 = document.querySelector('.third-parallel');

  const partners1 = Array.from(pTag1.querySelectorAll('img'));
  const partners2 = Array.from(pTag2.querySelectorAll('img'));
  const partners3 = Array.from(pTag3.querySelectorAll('img'));

  let count1 = 0;
  let count2 = 0;
  let count3 = 0;

  // 인덱스를 갱신하여 이미지가 무한히 반복되도록 하는 함수
  function marqueeText(count, element, partners, direction, speed) {
    const elementWidth = element.scrollWidth;

    // 이미지가 이동한 만큼 카운트를 증가시킨다.
    count += speed;

    // 카운트가 배열의 길이를 초과하면 첫 번째 이미지로 돌아감
    if (count > partners.length * 2.13 ) {  // 두 배로 늘린 길이만큼 카운트
      count = 0;  // 카운트를 0으로 리셋하여 처음으로
    }

    // 현재 이미지 인덱스에 맞춰서 transform을 설정
    const logoWidth = partners[0].offsetWidth + 96;  // 각 로고의 width + gap
    element.style.transform = `translateX(${direction * count * logoWidth}px)`;

    return count;
  }

  // 애니메이션 재귀 함수
  function animate() {
    // 속도 조절: count를 더 천천히 증가시킴
    const speed = 0.01; // 속도 낮추기 (기존 1에서 0.2로 변경)

    count1 = marqueeText(count1, pTag1, partners1, -1, speed); // 첫 번째 라인, 오른쪽에서 왼쪽
    count2 = marqueeText(count2, pTag2, partners2, 1, speed);  // 두 번째 라인, 왼쪽에서 오른쪽
    count3 = marqueeText(count3, pTag3, partners3, -1, speed); // 세 번째 라인, 오른쪽에서 왼쪽

    window.requestAnimationFrame(animate); // 애니메이션 재귀 호출
  }

  // 각 라인에 대해 로고 확장
  function extendLineWithLogos(line, direction) {
    const logos = Array.from(line.querySelectorAll('img'));
    const logoWidth = logos[0].offsetWidth + 96; // 단일 로고의 폭 + gap
    const requiredCopies = Math.ceil(window.innerWidth / logoWidth) * 2; // 화면 너비를 초과하도록 2배로 추가 복제

    let originalContent = line.innerHTML;
    let newContent = originalContent;

    // 복제하여 라인을 길게 만든다.
    for (let i = 0; i < requiredCopies; i++) {
      newContent += originalContent;
    }

    line.innerHTML = newContent;
    line.style.display = 'flex';
    line.style.whiteSpace = 'nowrap';
    
    // 각 라인의 초기 위치 설정
    if (direction === 'right') {
      line.style.transform = `translateX(-${logoWidth * 2}px)`; // 오른쪽으로 늘리기
    } else if (direction === 'left') {
      line.style.transform = `translateX(${logoWidth * 2}px)`; // 왼쪽으로 늘리기
    }
  }

  // 첫 번째, 두 번째, 세 번째 라인에 대해 로고 확장
  extendLineWithLogos(pTag1, 'right'); // 첫 번째 줄, 오른쪽으로
  extendLineWithLogos(pTag2, 'left');  // 두 번째 줄, 왼쪽으로
  extendLineWithLogos(pTag3, 'right'); // 세 번째 줄, 오른쪽으로

  animate(); // 애니메이션 시작
});
</script>
