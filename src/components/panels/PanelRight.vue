<script setup>
import ErrorView from '@/components/ErrorView.vue'
import CitySelect from '@/components/CitySelect.vue'
import DayCard from '@/components/DayCard.vue'
import Stat from '@/components/Stat.vue'
import { computed } from 'vue'

const { error, data, activeIndex } = defineProps({
  error: Object,
  data: Object,
  activeIndex: Number,
})

const emit = defineEmits(['select-index'])

const errorMap = new Map([
  [1006, 'Указанный город не найден'],
  [1003, 'Не передан город'],
])
const errorDisplay = computed(() => {
  return errorMap.get(error?.error?.code)
})
const statData = computed(() => {
  if (!data) {
    return []
  }

  return [
    {
      name: 'Влажность',
      value: data.forecast.forecastday[activeIndex].day.avghumidity + '%',
    },
    {
      name: 'Вероятность дождя',
      value: data.forecast.forecastday[activeIndex].day.daily_chance_of_rain + '%',
    },
    {
      name: 'Ветер',
      value: data.forecast.forecastday[activeIndex].day.maxwind_kph + 'км/ч',
    },
  ]
})
</script>

<template>
  <error-view v-if="error" :error="errorDisplay"></error-view>
  <div v-if="data" class="date-wrapper">
    <div class="date-stat-list">
      <Stat v-for="item in statData" :key="item" v-bind="item" />
    </div>
    <div class="date-card-list">
      <day-card
        v-for="(item, index) in data.forecast.forecastday"
        :key="item.date"
        :date="new Date(item.date)"
        :is-active="activeIndex === index"
        :temp="item.day.avgtemp_c"
        :weather-code="item.day.condition.code"
        @click="() => emit('select-index', index)"
      />
    </div>
  </div>
  <CitySelect />
</template>

<style scoped>
.date-wrapper {
  display: flex;
  flex-direction: column;
  gap: 85px;
  margin-bottom: 85px;
}

.date-card-list {
  display: flex;
  flex-direction: row;
}

.date-stat-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}
</style>
