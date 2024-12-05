<template>
  <div class="container">
      <div class="content">
          <Banner />
          <Data />
      </div>
  </div>
</template>

<script lang="ts" setup>
import Banner from "@/views/brother/workplace/components/banner.vue";
import Data from "@/views/brother/workplace/components/data.vue";
</script>

<script lang="ts">
  export default {
    name: 'Brother',
  };
</script>

<style lang="less" scoped>
  .container {
    background-color: var(--color-fill-2);
    padding: 20px;
    padding-bottom: 0;
    display: flex;
      width: 100vw;
      height: 100vh;
  }

  .content {

      width: 100%;
      background-color: var(--color-bg-2);
      border-radius: 4px 4px 0 0;
  }

</style>

<style lang="less" scoped>
  // responsive
  .mobile {
    .container {
      display: block;
    }
    .right-side {
      // display: none;
      width: 100%;
      margin-left: 0;
      margin-top: 16px;
    }
  }
</style>
