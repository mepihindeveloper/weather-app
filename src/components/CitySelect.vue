<script setup>
import StandardButton from '@/components/ui/StandardButton.vue'
import IconLocation from '@/components/icons/IconLocation.vue'
import { inject, ref } from 'vue'
import StandardInput from '@/components/ui/StandardInput.vue'
import { cityProvide } from '@/constants.js'

const isEditableMod = ref(false)
const city = inject(cityProvide)
const inputValue = ref(city.value)

function select() {
  isEditableMod.value = false
  city.value = inputValue.value
}

function edit() {
  isEditableMod.value = true
}
</script>

<template>
  <div class="city-select">
    <StandardButton v-if="!isEditableMod" @click="edit">
      <IconLocation />
      Изменить город
    </StandardButton>
    <div v-else class="city-input">
      <standard-input
        v-model="inputValue"
        v-focus
        placeholder="Введите город"
        @keyup.enter="select"
      />
      <StandardButton @click="select">Сохранить</StandardButton>
    </div>
  </div>
</template>

<style scoped>
.city-input {
  display: flex;
  flex-direction: row;
  gap: 12px;
}

.city-select {
  width: 420px;
}
</style>
