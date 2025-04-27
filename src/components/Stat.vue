<script setup>
const props = defineProps({
  name: String,
  value: String,
})
</script>

<template>
  <div class="stat">
    <div class="stat-name">{{ props.name }}</div>
    <div class="stat-value">{{ props.value }}</div>
  </div>
</template>

<style scoped>
.stat {
  display: flex;
  justify-content: space-between;
  font-size: 28px;
}

.stat-name {
  font-weight: 700;
  text-transform: uppercase;
}

.stat-value {
  font-weight: 500;
}
</style>
