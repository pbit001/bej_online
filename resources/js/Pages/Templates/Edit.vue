<template>
  <div>
    <Head :title="form.name" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/template">Templates</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message v-if="Template.deleted_at" class="mb-6" @restore="restore"> This Template has been deleted. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.template_title" :error="form.errors.template_title" class="pb-8 pr-6 w-full lg:w-1/2" label="Template Title" />
        </div>
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
        <textarea-input v-model="form.template_text" :error="form.errors.template_text" class="pb-8 pr-6 w-full lg:w-1/1" label="Template Content" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!Template.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Template</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Template</loading-button>
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
import TextareaInput from '@/Shared/TextareaInput'
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
    TextareaInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    Template: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        template_title: this.Template.template_title,
        template_text: this.Template.template_text
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/template/${this.Template.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this Template?')) {
        this.$inertia.delete(`/template/${this.Template.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this Template?')) {
        this.$inertia.put(`/template/${this.Template.id}/restore`)
      }
    },
  },
}
</script>
