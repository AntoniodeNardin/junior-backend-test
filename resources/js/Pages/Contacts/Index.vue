<template>
  <Default>
    <div class="mb-4">
      <button
        @click="showCreate = true"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        Novo Contato
      </button>
    </div>

    <table class="w-full border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-200">
          <th class="border border-gray-300 p-2">Nome</th>
          <th class="border border-gray-300 p-2">Email</th>
          <th class="border border-gray-300 p-2">Telefone</th>
          <th class="border border-gray-300 p-2">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="contact in contacts.data" :key="contact.id" class="hover:bg-gray-100">
          <td class="border border-gray-300 p-2">{{ contact.name }}</td>
          <td class="border border-gray-300 p-2">{{ contact.email }}</td>
          <td class="border border-gray-300 p-2">{{ contact.phone }}</td>
          <td class="border border-gray-300 p-2 space-x-2">
            <button
              @click="editContact(contact)"
              class="bg-yellow-400 px-3 py-1 rounded hover:bg-yellow-500"
            >
              Editar
            </button>
            <button
              @click="deleteContact(contact.id)"
              class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
            >
              Excluir
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Paginacao simples -->
    <div class="mt-4">
      <button
        @click="previousPage"
        :disabled="!contacts.prev_page_url"
        class="mr-2 px-3 py-1 border rounded disabled:opacity-50"
      >
        Anterior
      </button>
      <button
        @click="nextPage"
        :disabled="!contacts.next_page_url"
        class="px-3 py-1 border rounded disabled:opacity-50"
      >
        Próximo
      </button>
    </div>

    <!-- Modal de Criar/Editar -->
    <div v-if="showCreate || showEdit" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <div class="bg-white rounded p-6 w-96">
        <h2 class="text-xl mb-4">{{ showCreate ? 'Novo Contato' : 'Editar Contato' }}</h2>

        <form @submit.prevent="showCreate ? create() : update()">
          <label class="block mb-2">
            Nome:
            <input
              v-model="form.name"
              class="w-full border p-2 rounded"
              type="text"
              required
              minlength="3"
            />
          </label>

          <label class="block mb-2">
            Email:
            <input
              v-model="form.email"
              class="w-full border p-2 rounded"
              type="email"
              required
            />
          </label>

          <label class="block mb-4">
            Telefone:
            <input
              v-model="form.phone"
              class="w-full border p-2 rounded"
              type="text"
              required
              minlength="10"
            />
          </label>

          <div class="flex justify-end space-x-2">
            <button type="button" @click="closeModal" class="px-4 py-2 rounded border">
              Cancelar
            </button>
            <button
              type="submit"
              class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
              Salvar
            </button>
          </div>
        </form>
      </div>
    </div>
  </Default>
</template>

<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import Default from '@/Layouts/Default.vue';

const props = defineProps({
  contacts: Object,
});

const showCreate = ref(false);
const showEdit = ref(false);
const form = ref({
  id: null,
  name: '',
  email: '',
  phone: '',
});

function closeModal() {
  showCreate.value = false;
  showEdit.value = false;
  form.value = { id: null, name: '', email: '', phone: '' };
}

function create() {
  Inertia.post('/contacts', form.value, {
    onSuccess: () => closeModal(),
  });
}

function editContact(contact) {
  form.value = { ...contact };
  showEdit.value = true;
}

function update() {
  Inertia.put(`/contacts/${form.value.id}`, form.value, {
    onSuccess: () => closeModal(),
  });
}

function deleteContact(id) {
  if (confirm('Tem certeza que deseja excluir este contato?')) {
    Inertia.delete(`/contacts/${id}`);
  }
}

function previousPage() {
  if (props.contacts.prev_page_url) {
    Inertia.get(props.contacts.prev_page_url);
  }
}

function nextPage() {
  if (props.contacts.next_page_url) {
    Inertia.get(props.contacts.next_page_url);
  }
}
</script>
