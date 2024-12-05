<template>
    <a-space class="banner" wrap>
        <a-tag v-for="(color, index) of data.colors" :key="index" bordered>{{ color }}</a-tag>
        <a-button type="primary" @click="handleAdd">
            <template #icon>
                <icon-plus/>
            </template>
        </a-button>
    </a-space>
    <a-modal v-model:visible="visible" title="New One" @cancel="handleCancel" @before-close="handleBeforeClose">
        <a-form :model="form" :rules="rules">
            <a-form-item field="name" label="Name">
                <a-input v-model="form.name"/>
            </a-form-item>
        </a-form>
    </a-modal>
</template>

<script lang="ts" setup>
import {onMounted, onUnmounted, reactive, ref} from "vue";
import {Message} from "@arco-design/web-vue";
import {getBrotherList} from "@/api/brother";

const data = reactive({
    colors: [
        'orangered',
    ]
});
const visible = ref(false);
const form = reactive({
    name: '',
});
const rules = {
    name: [{ required: true }]
}
const handleAdd = () => {
    visible.value = true;
}
const handleCancel = () => {
    visible.value = false
}
const listener = (event) => {
    event.preventDefault();
    const pastedData = (event.clipboardData || window.clipboardData).getData('text');
    data.colors.push(pastedData)
    Message.success("添加成功")
}
const handleBeforeClose = () => {
    form.name = ''
}

const getBrotherListFn = async () => {
    const res = await getBrotherList()
}

getBrotherListFn()

onMounted(() => {
    document.addEventListener('paste', listener);
})
onUnmounted(() => {
    document.removeEventListener('paste', listener);
})
</script>

<style scoped lang="less">
.banner {
    width: 100%;
    padding: 0 20px;
    background-color: var(--color-bg-2);
    border-radius: 4px 4px 0 0;
}
</style>
