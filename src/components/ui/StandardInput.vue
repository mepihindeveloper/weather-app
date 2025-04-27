<script setup>
const data = defineModel({
  type: String,
  required: true,
})
</script>

<template>
  <input v-model="data" class="input" type="text" />
</template>

<style scoped>
.input {
  color: var(--color-primary);
  border: 0;
  border-radius: 10px;
  background-color: var(--color-bg-card);
  box-shadow: 1px 2px 4px 0 var(--color-bg-main);
  font-size: 18px;
  padding: 15px 20px;
  width: 260px;
  height: 53px;
}

.input::placeholder {
  color: var(--color-text-placeholder);
}
</style>
