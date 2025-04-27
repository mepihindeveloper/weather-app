<script setup>
const props = defineProps({
  error: String,
})
</script>

<template>
  <div v-if="props.error" class="error">{{ props.error }}</div>
</template>

<style scoped>
.error {
  font-family: var(--font);
  font-weight: 400;
  font-size: 18px;
  line-height: 100%;
  letter-spacing: 0;
  text-align: center;
  color: var(--color-primary);
  background-color: var(--color-bg-card);
  border-bottom-right-radius: 25px;
  border-bottom-left-radius: 25px;
  box-shadow: 1px 2px 4px 0 #222831;
  padding: 15px;
  margin-top: -60px;
  margin-bottom: 60px;
}
</style>
