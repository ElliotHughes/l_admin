<template>
    <a-col class="banner">
        <a-col :span="8">
            <a-typography-title :heading="5" style="margin-top: 0">
                {{ $t('brother.welcome') }}
            </a-typography-title>
        </a-col>
        <a-divider class="panel-border"/>
    </a-col>
</template>

<script lang="ts" setup>

</script>

<style scoped lang="less">
.banner {
    padding: 20px 20px 0 20px;
}

:deep(.arco-icon-home) {
    margin-right: 6px;
}
</style>
