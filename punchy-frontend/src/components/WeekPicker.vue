<script lang="ts" setup>
import VueDatePicker from '@vuepic/vue-datepicker'

const model = defineModel({
  type: Array<Date>
})
</script>

<template>
  <VueDatePicker
    v-model="model"
    :clearable="false"
    :enable-time-picker="false"
    auto-apply
    auto-close
    cancelText="annuleren"
    class="week-selector"
    locale="nl-BE"
    selectText="selecteren"
    timezone="Europe/Brussels"
    week-picker
  />
</template>

<style scoped>
.week-selector {
  width: 150px;
}
</style>
