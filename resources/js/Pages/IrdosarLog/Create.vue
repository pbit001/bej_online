<template>
  <div>
    <Head title="Create Dosare Inchise" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/organizations">Dosare Inchise</Link>
      <span class="text-indigo-400 font-medium">/</span> Inregistrare Dosar
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.Nr_Dosar" :error="form.errors.Nr_Dosar" class="pb-8 pr-6 w-full lg:w-1/2" label="Nr. Dosar" />
          <text-input v-model="form.Nume_Debitor" :error="form.errors.Nume_Debitor" class="pb-8 pr-6 w-full lg:w-1/2" label="Nume Debitor" />
          <text-input v-model="form.Prenume_Debitor" :error="form.errors.Prenume_Debitor" class="pb-8 pr-6 w-full lg:w-1/2" label="Prenume Debitor" />
          <number-input v-model="form.CNP_CUI" :error="form.errors.CNP_CUI" class="pb-8 pr-6 w-full lg:w-1/2" label="CNP/CUI Debitor" />
          <text-input v-model="form.Adresa_Debitor" :error="form.errors.Adresa_Debitor" class="pb-8 pr-6 w-full lg:w-1/2" label="Adresa Debitor" />
          <text-input v-model="form.Judet_Debitor" :error="form.errors.Judet_Debitor" class="pb-8 pr-6 w-full lg:w-1/2" label="Judet Debitor" />
          <text-input v-model="form.Primarie_Debitor" :error="form.errors.Primarie_Debitor" class="pb-8 pr-6 w-full lg:w-1/2" label="Primarie Debitor" />
          <select-input v-model="form.Judecatoria" :error="form.errors.Judecatoria" class="pb-8 pr-6 w-full lg:w-1/2" label="Judecatorie Debitor">
            <option :value="null" />
            <option value="ORADEA">ORADEA</option> 
            <option value="ALESD">ALESD</option> 
            <option value="BEIUS">BEIUS</option> 
            <option value="MARGHITA">MARGHITA</option> 
            <option value="ARAD">ARAD</option> 
            <option value="CHISINEU-CRIS">CHISINEU-CRIS</option> 
            <option value="GURAHONT">GURAHONT</option> 
            <option value="INEU">INEU</option> 
            <option value="LIPOVA">LIPOVA</option>
            <option value="TIMISOARA">TIMISOARA</option>
            <option value="DETA">DETA</option>
            <option value="FAGET">FAGET</option>
            <option value="LUGOJ">LUGOJ</option>
            <option value="SANICOLAUL MARE">SANICOLAUL MARE</option>
            <option value="CARANSEBES">CARANSEBES</option>
            <option value="MOLDOVA-NOUA">MOLDOVA-NOUA</option>
            <option value="ORAVITA">ORAVITA</option>
            <option value="RESITA">RESITA</option>
          </select-input>
          <text-input v-model="form.Nume_Creditor" :error="form.errors.Nume_Creditor" class="pb-8 pr-6 w-full lg:w-1/2" label="Nume Creditor" />
          <text-input v-model="form.Adresa_Creditor" :error="form.errors.Adresa_Creditor" class="pb-8 pr-6 w-full lg:w-1/2" label="Adresa Creditor" />
          <select-input v-model="form.Titlu_Executoriu" :error="form.errors.Titlu_Executoriu" class="pb-8 pr-6 w-full lg:w-1/2" label="Titlu Executoriu">
            <option value="-">Alege</option>
            <option value="Bilet la Ordin">Bilet la Ordin</option>
          </select-input>
          <text-input v-model="form.DataTitlu_Executoriu" :error="form.errors.DataTitlu_Executoriu" class="pb-8 pr-6 w-full lg:w-1/2" label="Data Titlu Executoriu" />
          <number-input v-model="form.Suma_CreditorInitiala" :error="form.errors.Suma_CreditorInitiala" class="pb-8 pr-6 w-full lg:w-1/2" label="Debit Creditor" />
          <number-input v-model="form.Taxa" :error="form.errors.Taxa" class="pb-8 pr-6 w-full lg:w-1/2" label="Taxa Juridica" />
          <number-input v-model="form.Cheltuieli" :error="form.errors.Cheltuieli" class="pb-8 pr-6 w-full lg:w-1/2" label="Cheltuieli(fara onorariu):" />
          <select-input v-model="form.Procent_Onorariu" :error="form.errors.Procent_Onorariu" class="pb-8 pr-6 w-full lg:w-1/2" label="Procent Onorariu">
            <option value="0">0</option> 
            <option value="1">1</option> 
            <option value="2">2 </option> 
            <option value="3">3</option> 
            <option value="4">4</option> 
            <option value="5">5</option> 
            <option value="6">6</option> 
            <option value="7">7</option> 
            <option value="8">8</option> 
            <option value="9">9</option> 
            <option value="10">10</option> 
          </select-input>
          <number-input v-model="form.Avans_Onorariu" :error="form.errors.Avans_Onorariu" class="pb-8 pr-6 w-full lg:w-1/2" label="Avans Onorariu" />
          <text-input v-model="form.Data_Introducerii" :error="form.errors.Data_Introducerii" class="pb-8 pr-6 w-full lg:w-1/2" label="Data Introducerii" />

          <text-input v-model="form.CoDebitor_Girant" :error="form.errors.CoDebitor_Girant" class="pb-8 pr-6 w-full lg:w-1/2" label="CoDebitor Girant" />
          
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Inregistrare</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import NumberInput from '@/Shared/NumberInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    NumberInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        Nr_Dosar: null,
        Nume_Debitor: null,
        Prenume_Debitor: null,
        CNP_CUI: null,
        Adresa_Debitor: null,
        Judet_Debitor: null,
        Primarie_Debitor: null,
        Judecatoria: null,
        Nume_Creditor: null,
        Adresa_Creditor: null,
        Titlu_Executoriu: null,
        DataTitlu_Executoriu: null,
        Suma_CreditorInitiala: null,
        Taxa: null,
        Cheltuieli: null,
        Procent_Onorariu: null,
        Avans_Onorariu: null,
        Data_Introducerii: null,
        
        CoDebitor_Girant: null,

      }),
    }
  },
  methods: {
    store() {
      this.form.post('/irdosarlogs')
    },
  },
}
</script>
