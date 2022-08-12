<template>
  <div>
    <Head :title="form.name" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/DosareDeschise">Dosare Deschise</Link>
      <span class="text-indigo-400 font-medium">/Notificari</span>
      {{ form.name }}
    </h1>
    
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <text-input v-model="form.Nr_Dosar" :error="form.errors.Nr_Dosar" class="pb-8 pr-6 w-full lg:w-1/2" label="Nr. Dosar" />
          <h2 class="mt-6 font-bold text-2xl" style="width: 100%; margin-bottom: 15px;">Partea Care Notifica</h2>
          <text-input v-model="form.ParteCare_Notifica" :error="form.errors.ParteCare_Notifica" class="pb-8 pr-6 w-full lg:w-1/1" label="ParteCare Notifica" />
          <text-input v-model="form.Date_ParteCareNotifica" :error="form.errors.Date_ParteCareNotifica" class="pb-8 pr-6 w-full lg:w-1/1" label="Date ParteCareNotifica" />


          <h2 class="mt-6 font-bold text-2xl" style="width: 100%; margin-bottom: 15px;">Partea Care Notificata</h2>
          <text-input v-model="form.Parte_Notificata" :error="form.errors.Parte_Notificata" class="pb-8 pr-6 w-full lg:w-1/1" label="Parte Notificata" />
          <text-input v-model="form.Date_ParteNotificata" :error="form.errors.Date_ParteNotificata" class="pb-8 pr-6 w-full lg:w-1/1" label="Date ParteCareNotificata" />
          
          
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
        <button  class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update </loading-button>
        </div>
      </form>
    </div> 
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import NumberInput from '@/Shared/NumberInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    Head,
    Icon,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
    NumberInput,
  },
  layout: Layout,
  props: {
    Notificari: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        Nr_Dosar: this.Notificari.Nr_Dosar,
        ParteCare_Notifica: this.Notificari.ParteCare_Notifica,
        Date_ParteCareNotifica: this.Notificari.Date_ParteCareNotifica,
        Parte_Notificata: this.Notificari.Parte_Notificata,
        Date_ParteNotificata: this.Notificari.Date_ParteNotificata,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/Notificari/${this.Notificari.ID}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this Dosare Deschise?')) {
        this.$inertia.delete(`/Notificari/${this.Notificari.ID}`)
      }
    },
  },
}
</script>
