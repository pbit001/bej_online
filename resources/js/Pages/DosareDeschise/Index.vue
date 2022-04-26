<template>
  <div>
    <Head title="Organizations" />
    <h1 class="mb-8 text-3xl font-bold">Dosare Deschise</h1>
    <div class="flex items-center justify-between mb-6">
      
      <Link class="btn-indigo" href="/DosareDeschise/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Dosare Deschise</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Istoric</th>
            <th class="pb-4 pt-6 px-6">Obs</th>
            <th class="pb-4 pt-6 px-6">Detalii</th>
            <th class="pb-4 pt-6 px-6">Nr Dosar </th>
            <th class="pb-4 pt-6 px-6">Nume Debitor</th>
            <th class="pb-4 pt-6 px-6">Prenume Debitor</th>
            <th class="pb-4 pt-6 px-6">CNP/CUI</th>
            <th class="pb-4 pt-6 px-6">Adresa Debitor</th>        
            <th class="pb-4 pt-6 px-6">Nume Creditor</th>
            <th class="pb-4 pt-6 px-6">Adresa Creditor</th>
            <th class="pb-4 pt-6 px-6">Titlu Executoriu</th>
            <th class="pb-4 pt-6 px-6">Data Titlu Executoriu</th>
            <th class="pb-4 pt-6 px-6">Suma Totala Initiala</th>         
            <th class="pb-4 pt-6 px-6">Suma Creditor Initiala</th>
            <th class="pb-4 pt-6 px-6">Total BEJ Initial</th>
            <th class="pb-4 pt-6 px-6">Suma Consemnata</th>         
            <th class="pb-4 pt-6 px-6">Data Consemnare Suma</th>
            <th class="pb-4 pt-6 px-6">Suma Distribuita Creditor</th>
            <th class="pb-4 pt-6 px-6">Suma Distribuita BEJ</th>
            <th class="pb-4 pt-6 px-6">Creanta</th>
            <th class="pb-4 pt-6 px-6">Data Interogare ANAF </th>
            <th class="pb-4 pt-6 px-6">Data Poprire Banca</th>
            <th class="pb-4 pt-6 px-6">Stadiu Dosar</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="organization in DosareDeschise.data" :key="organization.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/DosareDeschise/${organization.id}/edit`">
                Istoric
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/DosareDeschise/${organization.id}/edit`">
                Obs
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/DosareDeschise/${organization.id}/edit`">
                Detalii
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/DosareDeschise/${organization.id}/edit`">
                {{ organization.Nr_Dosar }}
                <icon v-if="organization.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/DosareDeschise/${organization.id}/edit`" tabindex="-1">
                {{ organization.Nume_Debitor }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/DosareDeschise/${organization.id}/edit`" tabindex="-1">
                {{ organization.Prenume_Debitor }}
              </Link>
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
                {{ organization.DataTitlu_Executoriu }}
            </td>
            <td class="border-t">
                {{ organization.Suma_TotalaInitiala }}
            </td>
            <td class="border-t">
                {{ organization.Suma_CreditorInitiala }}
            </td>
            <td class="border-t">
                {{ organization.Total_BEJInitial }}
            </td>
            <td class="border-t">
                {{ organization.Incasari_Totale }}
            </td>
            <td class="border-t">
                {{ organization.Data_Incasare }}
            </td>
            <td class="border-t">
                {{ organization.DataEmitere_Interogare }}
            </td>
            <td class="border-t">
                {{ organization.Suma_TrCreditor }}
            </td>
            <td class="border-t">
                {{ organization.Suma_TrBEJ }}
            </td>
            <td class="border-t">
                {{ organization.Poprire_Conturi }}
            </td>
            <td class="border-t">
                {{ organization.Stadiu_Dosar }}
            </td>
            <td class="border-t">
                {{ organization.Suma_TotalaRamasa }}
            </td>
          </tr>
          <tr v-if="DosareDeschise.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No data found.</td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="DosareDeschise.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    DosareDeschise: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/organizations', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
