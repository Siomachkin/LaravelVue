<script setup lang="ts">
import { onMounted, ref } from 'vue';
import axios from 'axios';


const manufacturers = ref<string[]>([]);
const selectedManufacturer = ref('');

onMounted(async () => {
    try {
        const response = await axios.get(route('manufacturers'));
        if (Array.isArray(response.data)) {
            manufacturers.value = response.data as string[];
        }
    } catch (error) {
        console.error('Error fetching manufacturers:', error);
    }
});
</script>

<template>
    <select v-model="selectedManufacturer" class="border-gray-300 rounded-md shadow-sm">
        <option value="">Dowolny producent</option>
        <option v-for="manufacturer in manufacturers" :key="manufacturer" :value="manufacturer">
            {{ manufacturer }}
        </option>
    </select>
</template>