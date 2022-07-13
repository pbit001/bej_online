<template>
  <div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/">
        <icon name="dashboard" class="mr-2 w-4 h-4" :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dashboard</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/organizations">
        <icon name="office" class="mr-2 w-4 h-4" :class="isUrl('organizations') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('organizations') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Organizations</div>
      </Link>
    </div>
    
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/DosareDeschise">
        <icon name="printer" class="mr-2 w-4 h-4" :class="isUrl('DosareDeschise') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('DosareDeschise') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dosare Deschise</div>
      </Link>
    </div>

    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/irdosarlogs">
        <icon name="printer" class="mr-2 w-4 h-4" :class="isUrl('irdosarlogs') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('irdosarlogs') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dosare Inchise</div>
      </Link>
    </div>

    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/interogare">
        <icon name="printer" class="mr-2 w-4 h-4" :class="isUrl('interogare') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('interogare') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Interogare</div>
      </Link>
    </div>

    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/ANAFAngajatori">
        <icon name="printer" class="mr-2 w-4 h-4" :class="isUrl('ANAFAngajatori') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('ANAFAngajatori') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Import Fisier Angajatori</div>
      </Link>
    </div>

    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/ANAFBanci">
        <icon name="printer" class="mr-2 w-4 h-4" :class="isUrl('ANAFBanci') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('ANAFBanci') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Import Fisier Conturi Bancare</div>
      </Link>
    </div>

    

  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'

export default {
  components: {
    Icon,
    Link,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
}
</script>
