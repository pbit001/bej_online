<template>
  <div>
    <Head :title="form.name" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/DosareDeschise">Dosare Deschise</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <text-input v-model="form.Nr_Dosar" :error="form.errors.Nr_Dosar" readonly class="pb-8 pr-6 w-full lg:w-1/2" label="Nr. Dosar" />
        <div class="pb-8 pr-6 w-full lg:w-1/2">
          <label class="form-label" for="text-Credit_Ipotecar">BIFATI PENTRU CONTRACT CU CREDIT IPOTECAR</label>
          <input id="text-Credit_Ipotecar" type="checkbox" v-model="form.Credit_Ipotecar" true-value="yes" false-value="no" number @click="checkFirstCheckbox">
        </div>
        

        <h2 class="mt-6 font-bold text-2xl" style="width: 100%; margin-bottom: 15px;">Demo Creditor</h2>
        <text-input v-model="form.Nume_Creditor" :error="form.errors.Nume_Creditor" class="pb-8 pr-6 w-full lg:w-1/2" label="Nume Creditor" />
        <text-input v-model="form.Adresa_Creditor" :error="form.errors.Adresa_Creditor" class="pb-8 pr-6 w-full lg:w-1/2" label="Adresa Creditor" />

        <h2 class="mt-6 font-bold text-2xl" style="width: 100%; margin-bottom: 15px;">Date De Identificare</h2>
        <text-input v-model="form.Nume_Reprezentant" :error="form.errors.Nume_Reprezentant" class="pb-8 pr-6 w-full lg:w-1/2" label="NUME / DENUMIRE REPREZENTANT" />
        <text-input v-model="form.Adresa_Reprezentant" :error="form.errors.Adresa_Reprezentant" class="pb-8 pr-6 w-full lg:w-1/2" label="ADRESA / SEDIU REPREZENTANT" />
        <text-input v-model="form.Identificare_Reprezentant" :error="form.errors.Identificare_Reprezentant" class="pb-8 pr-6 w-full lg:w-1/1" label="DATE DE IDENTIFICARE REPREZENTANT" />
        <text-input v-model="form.Creditor_Suplimentar" :error="form.errors.Creditor_Suplimentar" class="pb-8 pr-6 w-full lg:w-1/2" label="Detalii Creditori Suplimentari" />

        <h2 class="mt-12 font-bold text-2xl" style="width: 100%; margin-bottom: 15px;">Date Debitor</h2>
        <div class="pb-8 pr-6 w-full lg:w-1/2">
          <label class="form-label" for="text-Grant_Imobiliar">BIFATI PENTRU GARANT IMOBILIAR</label>
          <input id="text-Grant_Imobiliar" type="checkbox" v-model="form.Grant_Imobiliar" true-value="yes" false-value="no" number @click="checkSecondCheckbox">
          
        </div>
        <text-input v-model="form.Nume_Debitor" :error="form.errors.Nume_Debitor" class="pb-8 pr-6 w-full lg:w-1/2" label="Nume Debitor" />
        <text-input v-model="form.Prenume_Debitor" :error="form.errors.Prenume_Debitor" class="pb-8 pr-6 w-full lg:w-1/2" label="Prenume Debitor" />.
        <number-input v-model="form.CNP_CUI" :error="form.errors.CNP_CUI" class="pb-8 pr-6 w-full lg:w-1/2" label="CNP/CUI Debitor" />
        <text-input v-model="form.Adresa_Debitor" :error="form.errors.Adresa_Debitor" class="pb-8 pr-6 w-full lg:w-1/2" label="Adresa Debitor" />
        <text-input v-model="form.Debitor_Suplimentar" :error="form.errors.Debitor_Suplimentar" class="pb-8 pr-6 w-full lg:w-1/2" label="Detalii Debitori Suplimentari" />
        <text-input v-model="form.Primarie_Debitor" :error="form.errors.Primarie_Debitor" class="pb-8 pr-6 w-full lg:w-1/2" label="Primarie Debitor" />


        <h2 class="mt-12 font-bold text-2xl" style="width: 100%; margin-bottom: 15px;">Obiect</h2>
        <text-input v-model="form.Obiect" :error="form.errors.Obiect" class="pb-8 pr-6 w-full lg:w-1/2" label="Obiect" />
        <text-input v-model="form.Obiect_Suplimentar" :error="form.errors.Obiect_Suplimentar" class="pb-8 pr-6 w-full lg:w-1/2" label="Detalii Obiect Suplimentar" />
        <select-input v-model="form.Titlu_Executoriu" :error="form.errors.Titlu_Executoriu" class="pb-8 pr-6 w-full lg:w-1/2" label="Titlu Executoriu">
            <option value="-">Alege</option>
            <option value="Bilet la Ordin">Bilet la Ordin</option>
          </select-input>
          <text-input v-model="form.Acte" :error="form.errors.Acte" class="pb-8 pr-6 w-full lg:w-1/2" label="ACTE ADITIONALE" />
        
        <h2 class="mt-12 font-bold text-2xl" style="width: 100%; margin-bottom: 15px;">Financiar</h2> 
        <text-input v-model="form.Suma_TotalaInitiala" :error="form.errors.Suma_TotalaInitiala" class="pb-8 pr-6 w-full lg:w-1/2" label="DEBIT RESTANT" />
        <div class="pb-8 pr-6 w-full lg:w-1/2">
          <label class="form-label" for="text-debit_variabil">BIFA DEBIT VARIABIL</label>
          <input id="text-debit_variabil" type="checkbox" v-model="form.debit_variabil" true-value="yes" false-value="no" number @click="checkThirdCheckbox">
        </div>
        <number-input v-model="form.Taxa" :error="form.errors.Taxa" class="pb-8 pr-6 w-full lg:w-1/2" label="Taxa Juridica" />
        <number-input v-model="form.Taxa_Ad1" :error="form.errors.Taxa_Ad1" class="pb-8 pr-6 w-full lg:w-1/2" label="Taxa Additional 1" />
        <number-input v-model="form.Taxa_Ad2" :error="form.errors.Taxa_Ad2" class="pb-8 pr-6 w-full lg:w-1/2" label="Taxa Additional 2" />
        <number-input v-model="form.Taxa_Ad3" :error="form.errors.Taxa_Ad3" class="pb-8 pr-6 w-full lg:w-1/2" label="Taxa Additional 3" />
        <number-input v-model="form.Taxa_Ad4" :error="form.errors.Taxa_Ad4" class="pb-8 pr-6 w-full lg:w-1/2" label="Taxa Additional 4" />
        <number-input v-model="form.Onorariu" :error="form.errors.Onorariu" class="pb-8 pr-6 w-full lg:w-1/2" label="ONORARIU (PROCENT SAU INTRODUS DIRECT)" />
        <number-input v-model="form.Cheltuieli" :error="form.errors.Cheltuieli" class="pb-8 pr-6 w-full lg:w-1/2" label="Cheltuieli(fara onorariu)" />

        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
        <button  class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Dosare Deschise</loading-button>
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
    DosareDeschise: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        Nr_Dosar: this.DosareDeschise.Nr_Dosar,
        Credit_Ipotecar: this.DosareDeschise.Credit_Ipotecar,
        Nume_Creditor: this.DosareDeschise.Nume_Creditor,
        Adresa_Creditor: this.DosareDeschise.Adresa_Creditor,
        Nume_Reprezentant: this.DosareDeschise.Nume_Reprezentant,
        Adresa_Reprezentant: this.DosareDeschise.Adresa_Reprezentant,
        Identificare_Reprezentant: this.DosareDeschise.Identificare_Reprezentant,
        Creditor_Suplimentar: this.DosareDeschise.Creditor_Suplimentar,
        Grant_Imobiliar: this.DosareDeschise.Grant_Imobiliar,
        Nume_Debitor: this.DosareDeschise.Nume_Debitor,
        Prenume_Debitor: this.DosareDeschise.Prenume_Debitor,
        CNP_CUI: this.DosareDeschise.CNP_CUI,
        Adresa_Debitor: this.DosareDeschise.Adresa_Debitor,
        Debitor_Suplimentar: this.DosareDeschise.Debitor_Suplimentar,
        Primarie_Debitor: this.DosareDeschise.Primarie_Debitor,
        Obiect: this.DosareDeschise.Obiect,
        Obiect_Suplimentar: this.DosareDeschise.Obiect_Suplimentar,        
        Titlu_Executoriu: this.DosareDeschise.Titlu_Executoriu,

        debit_variabil: this.DosareDeschise.debit_variabil,
        Taxa: this.DosareDeschise.Taxa,
        Taxa_Ad1: this.DosareDeschise.Taxa_Ad1,
        Taxa_Ad2: this.DosareDeschise.Taxa_Ad2,
        Taxa_Ad3: this.DosareDeschise.Taxa_Ad3,
        Taxa_Ad4: this.DosareDeschise.Taxa_Ad4,
        Cheltuieli: this.DosareDeschise.Cheltuieli,
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/DosareDeschise/${this.DosareDeschise.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this Dosare Deschise?')) {
        this.$inertia.delete(`/DosareDeschise/${this.DosareDeschise.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this Dosare Deschise?')) {
        this.$inertia.put(`/DosareDeschise/${this.DosareDeschise.id}/restore`)
      }
    },
  },
}
</script>
