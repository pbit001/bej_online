<template>
  <div>
    <Head title="Adresa ITM" />
    <h1 class="mb-8 text-3xl font-bold">Adresa ITM</h1>
    
    <div class="bg-white rounded-md shadow overflow-x-auto" style="padding: 10px;">
    <form @submit.prevent="download_template">
        <table class="w-full whitespace-nowrap table table-hover table-bordered" id="example">
          <thead>
            <tr class="text-left font-bold" >
              <th class="pb-4 pt-6 px-6"><input type="checkbox" v-model="selectAll">Select ID</th>
              <th class="pb-4 pt-6 px-6">Nr Dosar </th>
              <th class="pb-4 pt-6 px-6">Nume Debitor</th>
              <th class="pb-4 pt-6 px-6">Prenume Debitor</th>
              <th class="pb-4 pt-6 px-6">CNP/CUI</th>
              <th class="pb-4 pt-6 px-6">Adresa Debitor</th>        
              <th class="pb-4 pt-6 px-6">Nume Creditor</th>
              <th class="pb-4 pt-6 px-6">Adresa Creditor</th>
              <th class="pb-4 pt-6 px-6">Titlu Executoriu</th>
              <th class="pb-4 pt-6 px-6">Suma Totala Ramasa</th>
              <th class="pb-4 pt-6 px-6">Stadiu Dosar</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="organization in DosareDeschise.data" :key="organization.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
              <td class="border-t">
              
                <input type="checkbox" v-model="form.records" :value="organization.Nr_Dosar" number>
              </td>
              <td class="border-t">
                  {{ organization.Nr_Dosar }}
              </td>
              <td class="border-t">
                  {{ organization.Nume_Debitor }}
              </td>
              <td class="border-t">
                
                  {{ organization.Prenume_Debitor }}
                
              </td>
              <td class="border-t">
                  {{ organization.CNP_CUI }}
              </td>
              <td class="border-t">
                  {{ organization.Adresa_Debitor }}
              </td>
              <td class="border-t">
                  {{ organization.Nume_Creditor }}
              </td>
              <td class="border-t">
                  {{ organization.Adresa_Creditor }}
              </td>
              <td class="border-t">
                  {{ organization.Titlu_Executoriu }}
              </td>
            <td class="border-t">
                  {{ organization.Suma_TotalaRamasa }}
              </td>
              <td class="border-t">
                  {{ organization.Stadiu_Dosar }}
              </td>
            </tr>
            <tr v-if="DosareDeschise.data.length === 0">
              <td class="px-6 py-4 border-t" colspan="4">No data found.</td>
            </tr>
          </tbody>
        </table>
        <loading-button :loading="form.processing" class="btn-indigo" type="submit">Creaza</loading-button>
      </form>
    </div>
    <pagination class="mt-6" :links="DosareDeschise.links" />
  </div>
</template>

<script>

//Bootstrap and jQuery libraries

import 'jquery/dist/jquery.min.js';
//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables"
import "datatables.net-dt/css/jquery.dataTables.min.css"
import $ from 'jquery'; 

import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import LoadingButton from '@/Shared/LoadingButton'
import axios from 'axios'

export default {
  components: {
    Head,
    Icon,
    Link,
    LoadingButton,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    DosareDeschise: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        records: []
      }),
    }
  },
  computed: {
    selectAll: {
        get: function () {
            return this.DosareDeschise ? this.form.records.length == this.DosareDeschise.data.length : false;
        },
        set: function (value) {
            var records = [];
      
            if (value) {
                this.DosareDeschise.data.forEach(function (DosareDeschisesing) {
                    records.push(DosareDeschisesing.Nr_Dosar);
                });
            }
            this.form.records = records;
        }
    }
  },
  mounted(){
    $('#example').DataTable();
  },
  watch: {
    form: {
      deep: true,
     
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    download_template() {
      console.log('test submit download template');
      axios({
      url: '/download_template/',
      method: 'POST',
      data: this.form,
      responseType: 'blob', // important
    }).then((response) => {
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', 'file.pdf');
      document.body.appendChild(link);
      link.click();
    });
      
    },
    
  },
}

</script>
