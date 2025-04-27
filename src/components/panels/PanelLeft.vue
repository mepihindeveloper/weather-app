<script setup>
import IconLocation from '@/components/icons/IconLocation.vue'
import IconSun from '@/components/icons/weather/IconSun.vue'
import { computed, inject } from 'vue'
import { cityProvide } from '@/constants.js'
import IconCloud from '@/components/icons/weather/IconCloud.vue'
import IconRain from '@/components/icons/weather/IconRain.vue'

const { dayData } = defineProps({
  dayData: Object,
})
const weekDay = computed(() => {
  if (!dayData) {
    return '-'
  }
  return new Date(dayData.date).toLocaleDateString('ru-RU', { weekday: 'long' })
})
const fullDate = computed(() => {
  if (!dayData) {
    return '-'
  }
  return new Date(dayData.date).toLocaleDateString('ru-RU', {
    day: '2-digit',
    weekday: 'long',
    year: 'numeric',
  })
})
const weatherCode = computed(() => {
  if (!dayData) {
    return '-'
  }
  return dayData.day.condition.code
})
const city = inject(cityProvide)
</script>

<template>
  <div class="date">
    <p class="day">{{ weekDay }}</p>
    <p class="full-date">{{ fullDate }}</p>
    <div class="location">
      <icon-location />
      {{ dayData ? city : '-' }}
    </div>
  </div>
  <div class="weather">
    <div class="icon">
      <icon-sun v-if="weatherCode <= 1003" size="95" />
      <icon-cloud v-if="weatherCode >= 1006 && weatherCode < 1063" size="95" />
      <icon-rain v-if="weatherCode >= 1063" size="95" />
    </div>
    <p class="temp">{{ dayData?.day?.avgtemp_c ?? '-' }} °C</p>
    <p class="weather-type">{{ dayData?.day?.condition?.text ?? '-' }}</p>
  </div>
</template>

<style scoped>
.date {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.day {
  font-weight: 700;
  font-size: 37px;
  line-height: 100%;
  letter-spacing: 0;
  text-transform: capitalize;
}

.full-date {
  font-weight: 500;
  font-size: 22px;
  line-height: 100%;
  letter-spacing: 0;
}

.location {
  font-weight: 600;
  font-size: 20px;
  line-height: 100%;
  letter-spacing: 0;
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 8px;
}

.weather {
  display: flex;
  flex-direction: column;
  gap: 9px;
}

.weather .icon {
  margin-left: 20px;
  margin-bottom: 25px;
}

.temp {
  font-weight: 700;
  font-size: 50px;
  line-height: 100%;
  letter-spacing: 0;
}

.weather-type {
  font-weight: 700;
  font-size: 30px;
  line-height: 100%;
  letter-spacing: 0;
  margin-top: 4px;
}
</style>
