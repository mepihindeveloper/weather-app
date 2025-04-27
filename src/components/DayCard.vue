<script setup>
import IconSun from '@/components/icons/weather/IconSun.vue'
import IconCloud from '@/components/icons/weather/IconCloud.vue'
import IconRain from '@/components/icons/weather/IconRain.vue'
import { computed } from 'vue'

const { weatherCode, temp, date, isActive } = defineProps({
  weatherCode: {
    type: Number,
    default: 1000,
  },
  temp: {
    type: Number,
    default: 0,
  },
  date: {
    type: Date,
    default: new Date(),
  },
  isActive: {
    type: Boolean,
    default: false,
  },
})
const iconColor = computed(() => {
  return isActive ? 'var(--color-primary-inverted)' : 'var(--color-primary)'
})
</script>

<template>
  <button :class="{ active: isActive }" class="day-card">
    <icon-sun v-if="weatherCode <= 1003" :color="iconColor" />
    <icon-cloud v-if="weatherCode >= 1006 && weatherCode < 1063" :color="iconColor" />
    <icon-rain v-if="weatherCode >= 1063" :color="iconColor" />

    <span class="date">
      {{ date.toLocaleDateString('ru-RU', { weekday: 'short' }) }}
    </span>
    <span class="temp"> {{ temp }} °C </span>
  </button>
</template>

<style scoped>
.day-card {
  width: 100%;
  padding: 20px 24px;
  background-color: var(--color-bg-card);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 15px;
  font-family: var(--font);
  font-size: 20px;
  line-height: 100%;
  letter-spacing: 0;
  text-align: center;
  border-radius: 10px;
  border: 0;
  cursor: pointer;
  box-shadow: 1px 2px 4px 0 #222831;
  color: var(--color-primary);
}

.day-card .date {
  font-weight: 400;
}

.day-card .temp {
  font-weight: 700;
}

.day-card:not(.active):hover {
  background-color: #3a434f;
}

.day-card.active {
  background-color: var(--color-primary);
  color: var(--color-primary-inverted);
}
</style>
