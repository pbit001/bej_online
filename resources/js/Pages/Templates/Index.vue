<template>
  <div>
    <Head title="Templates" />
    <h1 class="mb-8 text-3xl font-bold">Organizations</h1>
    <div class="flex items-center justify-between mb-6">
      <Link class="btn-indigo" href="/template/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;template</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6" colspan="2">Template Title</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="organization in Template.data" :key="organization.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/template/${organization.id}/edit`">
                {{ organization.template_title }}
                <icon v-if="organization.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
              </Link>
            </td>
            
            <td class="w-px border-t">
              <Link class="flex items-center px-4" :href="`/template/${organization.id}/edit`" tabindex="-1">
                <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
              </Link>
            </td>
          </tr>
          <tr v-if="Template.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No organizations found.</td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="Template.links" />
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
    Template: Object,
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
    destroy(id) {
      if (confirm('Are you sure you want to delete this organization?')) {
        this.$inertia.delete(`/DosareDeschise/${id}`)
      }
    },
  },
}
</script>
