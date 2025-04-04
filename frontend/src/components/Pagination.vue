<template>
  <div class="flex justify-center items-center space-x-2 mt-8">
    <button
      @click="$emit('page-change', pagination.current_page - 1)"
      :disabled="pagination.current_page === 1"
      class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
    >
      Anterior
    </button>
    
    <span class="px-4 py-2">
      Página {{ pagination.current_page }} de {{ pagination.total_pages }}
    </span>
    
    <button
      @click="$emit('page-change', pagination.current_page + 1)"
      :disabled="pagination.current_page === pagination.total_pages"
      class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
    >
      Próxima
    </button>
  </div>
</template>

<script>
export default {
  name: 'Pagination',
  props: {
    pagination: {
      type: Object,
      required: true
    }
  }
}
</script> 