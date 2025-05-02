<script setup>
import { onMounted, provide, ref, watch } from 'vue'
import PanelRight from '@/components/panels/PanelRight.vue'
import { API_ENDPOINT, cityProvide } from '@/constants.js'
import PanelLeft from '@/components/panels/PanelLeft.vue'

const activeIndex = ref(0)
const error = ref()
const data = ref()
const city = ref('Москва')

provide(cityProvide, city)

watch(city, () => {
  getCity(city.value);
});

onMounted(() => {
  getCity(city.value);
});

async function getCity(city) {
  const params = new URLSearchParams({ city: city})
  const response = await fetch(`${API_ENDPOINT}/server?${params.toString()}`)
  if (response.status !== 200) {
    error.value = await response.json()
    data.value = null
    return
  }
  error.value = null
  data.value = await response.json()
}

function setActive(index) {
  activeIndex.value = index
}
</script>

<template>
  <main class="main">
    <div class="left-panel">
      <panel-left :day-data="data?.forecast?.forecastday[activeIndex]" />
    </div>
    <div class="right-panel">
      <panel-right :active-index="activeIndex" :data :error @select-index="setActive" />
    </div>
  </main>
</template>

<style scoped>
.main {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
}

.left-panel {
  width: 500px;
  height: 680px;
  border-radius: 30px;
  background-image: url(/public/bg.png);
  background-repeat: no-repeat;
  background-size: cover;
  padding-left: 32px;
  padding-right: 32px;
  padding-top: 48px;
  padding-bottom: 84px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.right-panel {
  background: var(--color-bg-main);
  padding: 60px 50px;
  border-radius: 0 25px 25px 0;
  height: 642px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

@media (max-width: 768px) {
  .main {
    flex-direction: column;
    padding: 10px;
  }
  .left-panel {
    flex-direction: row;
    max-width: 500px;
    max-height: 200px;
    width: 100%;
    align-items: center;
    padding-bottom: 20px;
    padding-top: 20px;
  }
  .right-panel {
    padding: 20px;
    background-color: transparent;
    height: auto;
  }
}
</style>
