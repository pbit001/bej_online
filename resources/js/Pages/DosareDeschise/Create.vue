<template>
  <div>
    <Head title="Create Dosare Deschise" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/organizations">Dosare Deschise</Link>
      <span class="text-indigo-400 font-medium">/</span> Inregistrare Dosar
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden" style="float: left; margin-right: 15px;">
      <form @submit.prevent="store_notificari">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8"> 
          <text-input v-model="form1.Nr_Dosar_1" :error="form1.errors.Nr_Dosar_1" class="pb-8 pr-6 w-full lg:w-1/2" label="Nr. Dosar" />
          <h2 class="mt-6 font-bold text-2xl" style="width: 100%; margin-bottom: 15px;">Partea Care Notifica</h2>
          <text-input v-model="form1.ParteCare_Notifica" :error="form1.errors.ParteCare_Notifica" class="pb-8 pr-6 w-full lg:w-1/1" label="ParteCare Notifica" />
          <text-input v-model="form1.Date_ParteCareNotifica" :error="form1.errors.Date_ParteCareNotifica" class="pb-8 pr-6 w-full lg:w-1/1" label="Date ParteCareNotifica" />


          <h2 class="mt-6 font-bold text-2xl" style="width: 100%; margin-bottom: 15px;">Partea Care Notificata</h2>
          <text-input v-model="form1.Parte_Notificata" :error="form1.errors.Parte_Notificata" class="pb-8 pr-6 w-full lg:w-1/1" label="Parte Notificata" />
          <text-input v-model="form1.Date_ParteNotificata" :error="form1.errors.Date_ParteNotificata" class="pb-8 pr-6 w-full lg:w-1/1" label="Date ParteCareNotificata" />
          
          
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Inregistrare</loading-button>
        </div>
      </form>
    </div>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <text-input v-model="form.Nr_Dosar" :error="form.errors.Nr_Dosar" class="pb-8 pr-6 w-full lg:w-1/2" label="Nr. Dosar" />
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
  props: {
    NewOrder: Object,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        Nr_Dosar: null,
        Credit_Ipotecar: "no",
        Nume_Creditor: null,
        Adresa_Creditor: null,
        Nume_Reprezentant: null,
        Adresa_Reprezentant: null,
        Identificare_Reprezentant: null,
        Creditor_Suplimentar: null,
        Grant_Imobiliar: null,
        Nume_Debitor: null,
        Prenume_Debitor: null,
        CNP_CUI: null,       
        Adresa_Debitor: null,
        Debitor_Suplimentar: null,
        Primarie_Debitor: null,
        Obiect: null,
        Obiect_Suplimentar: null,
        Titlu_Executoriu: null,
        Suma_TotalaInitiala: null,
        debit_variabil: "no",
        Taxa: null,
        Taxa_Ad1: null,
        Taxa_Ad2: null,
        Taxa_Ad3: null,
        Taxa_Ad4: null,
        Onorariu: null,
        Cheltuieli: null,

      }),
      form1: this.$inertia.form({
        Nr_Dosar_1: null,
        ParteCare_Notifica: null,
        Date_ParteCareNotifica: null,
        Parte_Notificata: null,
        Date_ParteNotificata: null,

      }),
    }
  },
  mounted(){
    console.log(this.NewOrder);
  },
  methods: {
    store() {
      this.form.post('/DosareDeschise')
    },
   store_notificari() {
      this.form1.post('/DosareDeschiseNotificare')
    },
     
    checkFirstCheckbox() {
      
      setTimeout(function(scope) {

            if(scope.form.Credit_Ipotecar == "yes") {

              if (confirm('Are you sure you want to delete this Dosare Deschise?')) {
                //scope.form.Credit_Ipotecar = "yes";
              } else {
                scope.form.Credit_Ipotecar = "no";
              }
            }
             
        }, 200, this);

    },
    checkSecondCheckbox() {
      
      setTimeout(function(scope) {

            if(scope.form.Grant_Imobiliar == "yes") {

              if (confirm('Are you sure you want to delete this Dosare Deschise?')) {
                //scope.form.Grant_Imobiliar = "yes";
              } else {
                scope.form.Grant_Imobiliar = "no";
              }
            }

        }, 200, this);

    },
  },
}
</script>
