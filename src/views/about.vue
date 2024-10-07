<template>
  <div class="about-container">
    <h1>關於我們</h1>
    <p class="intro">
      歡迎來到我們的飲料店！我們致力於提供新鮮、美味且健康的飲品，讓每一位顧客都能享受到完美的飲品體驗。
    </p>
    
    <section class="mission-section">
      <h2>我們的使命</h2>
      <p>
        我們的使命是使用最優質的原料，調製出讓人愉悅的飲品，並為顧客創造難忘的用餐時光。我們相信，每一杯飲料都承載著我們對品質的承諾。
      </p>
    </section>

    <section class="vision-section">
      <h2>我們的願景</h2>
      <p>
        我們希望成為本地最受歡迎的飲料店，讓每一位顧客在這裡感受到溫暖和關懷。我們的願景是讓健康飲品走進每一個家庭。
      </p>
    </section>

    <section class="contact-section">
      <h2>聯繫我們</h2>
      <p>
        地址：123 飲料街，城市名，國家<br />
        電話：+123 456 7890<br />
        電子郵件：info@beviarestore.com
      </p>
    </section>
  </div>
</template>

<script lang="ts" setup name="about">

</script>

<style scoped>
  .about-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
  }

  h1 {
    text-align: center;
    color: #4CAF50; /* 主色調 */
  }

  h2 {
    color: #333;
    margin-top: 30px;
  }

  .intro {
    text-align: center;
    font-size: 1.2em;
    margin-bottom: 20px;
  }

  section {
    margin: 20px 0;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
  }
</style>