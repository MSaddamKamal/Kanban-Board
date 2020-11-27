<template>
  <form
    class="relative mb-3 flex flex-col justify-between bg-white rounded-md shadow overflow-hidden"
    @submit.prevent="handleAddNewItem"
  >
    <div class="p-3 flex-1">
      <input
        class="block w-full px-2 py-1 text-lg border-b border-blue-800 rounded"
        type="text"
        placeholder="Enter a title"
        v-model.trim="newItem.title"
      />
      <textarea
        class="mt-3 p-2 block w-full p-1 border text-sm rounded"
        rows="2"
        placeholder="Add a description (optional)"
        v-model.trim="newItem.description"
      ></textarea>
      <div v-show="errorMessage">
        <span class="text-xs text-red-500">
          {{ errorMessage }}
        </span>
      </div>
    </div>
    <div class="p-3 flex justify-between items-end text-sm bg-gray-100">
      <button
        @click="$emit('item-canceled')"
        type="reset"
        class="py-1 leading-5 text-gray-600 hover:text-gray-700"
      >
        cancel
      </button>
      <button
        type="submit"
        class="px-3 py-1 leading-5 text-white bg-pink-900 hover:bg-pink-800 rounded"
      >
        Add
      </button>
    </div>
  </form>
</template>

<script>
export default {
  props: {
    categoryId: Number
  },
  data() {
    return {
      newItem: {
        title: "",
        description: "",
        category_id: null
      },
      errorMessage: ""
    };
  },
  mounted() {
    this.newItem.category_id = this.categoryId;
  },
  methods: {
    handleAddNewItem() {
      // Basic validation so we don't send an empty item to the server
      if (!this.newItem.title) {
        this.errorMessage = "The title field is required";
        return;
      }

      // Send new item to server
      axios
        .post("/items", this.newItem)
        .then(res => {
          // Tell the parent component we've added a new item and include it
          this.$emit("item-added", res.data);
        })
        .catch(err => {
          // Handle the error returned from our request
          this.handleErrors(err);
        });
    },
    handleErrors(err) {
      if (err.response && err.response.status === 422) {
        // We have a validation error
        const errorBag = err.response.data.errors;
        if (errorBag.title) {
          this.errorMessage = errorBag.title[0];
        } else if (errorBag.description) {
          this.errorMessage = errorBag.description[0];
        } else {
          this.errorMessage = err.response.message;
        }
      } else {
        // We have bigger problems
        console.log(err.response);
      }
    }
  }
};
</script>
