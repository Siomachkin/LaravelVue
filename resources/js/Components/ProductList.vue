
<template>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 pt-8">
      <div v-for="product in products" :key="product.id" class="p-4 border border-gray-200 rounded-lg">
        <h2 class="text-xl font-bold">{{ product.name }}</h2>
        <p>Producent: {{ product.producer || '-' }}</p>
        <p>Waga: {{ product.weight || '-' }}</p>
        <p>Średnica: {{ product.diameter || '-' }}</p>
        <p>Długość: {{ product.length || '-' }}</p>
        <p>Szerokość: {{ product.width || '-' }}</p>
        <p>Wysokość: {{ product.height || '-' }}</p>
        <p>Grubość: {{ product.thickness || '-' }}</p>
        <p>Typ pakowania: {{ product.packaging_type || '-' }}</p>
        <p class="mt-2">
            Jednostki zakupu:
            <span class="font-bold text-indigo-600">{{ calculatePurchaseUnits(product) }}</span>
        </p>
      </div>
    </div>
</template>
  
<script>
export default {
  props: {
    products: {
      type: Array,
      required: true
    }
  },
  methods: {
    calculatePurchaseUnits(product) {
      const unitsPerPallet = {
        'rolki': 80,
        'kartony': 7,
        'M': 200,
        'M2': 150,
        'sztuki': 400
      };

      let result = '';
      let unitType = product.price_unit;
      let additionalInfo = '';

      if (product.unit_name === 'pełna paleta' && product.packaging_type === 'rolka') {
        additionalInfo = ' (80 rolek)';
      } else if (product.unit_name === 'pełna paleta' && product.packaging_type === 'karton') {
        additionalInfo = ' (7 kartonów)';
      }

      if (!product.purchase_units && product.unit_name === 'szt') {
        result = '1 ' + unitType;
      } else if (product.purchase_units && product.unit_name === 'szt') {
        result = product.purchase_units + ' szt';
      } else if (product.unit_name === 'pełna paleta') {
        if (unitType in unitsPerPallet) {
          result = unitsPerPallet[unitType] + ' ' + unitType + additionalInfo;
        } else {
          result = '400 sztuk'; // Default to 'sztuki' if the unit type is not recognized
        }
      } else if (product.unit_name === 'paczka' && unitType === 'paczka') {
        result = product.purchase_units + ' paczka';
      } else if (product.unit_name === 'paczka' && unitType !== 'paczka') {
        if (unitType in unitsPerPallet) {
          result = (unitsPerPallet[unitType] / 2) + ' ' + unitType;
        } else {
          result = '200 sztuk'; // Half of default units per pallet
        }
      } else {
        result = '1 ' + unitType; // Fallback for any other cases
      }

      return result;
    }
  }
}
</script>