<template>
  <div class="flex items-center space-x-4 mb-6">
    <div class="flex items-center space-x-2">
      <label for="sort-by" class="text-gray-700">Ordenar por:</label>
      <select
        id="sort-by"
        v-model="sortBy"
        @change="handleSortChange"
        class="px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        <option value="preco">Preço</option>
        <option value="nome">Nome</option>
      </select>
    </div>

    <div class="flex items-center space-x-2">
      <label for="sort-order" class="text-gray-700">Ordem:</label>
      <select
        id="sort-order"
        v-model="sortOrder"
        @change="handleSortChange"
        class="px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
        <option value="asc">Crescente</option>
        <option value="desc">Decrescente</option>
      </select>
    </div>
  </div>
</template>

<script>
import { ref, watch } from 'vue'

export default {
  name: 'SortControls',
  props: {
    initialSortBy: {
      type: String,
      default: 'preco'
    },
    initialSortOrder: {
      type: String,
      default: 'asc'
    }
  },
  setup(props, { emit }) {
    const sortBy = ref(props.initialSortBy)
    const sortOrder = ref(props.initialSortOrder)

    const handleSortChange = () => {
      emit('sort-change', { sortBy: sortBy.value, sortOrder: sortOrder.value })
    }

    return {
      sortBy,
      sortOrder,
      handleSortChange
    }
  }
}
</script> 