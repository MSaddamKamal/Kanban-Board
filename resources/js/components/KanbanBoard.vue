<template>
  <div class="relative p-2 flex overflow-x-auto h-full">

    <!-- Columns (categories) -->
    <modal name="category-title">

      <div class=" rounded-lg shadow-lg bg-white ">
        <div class="flex justify-between border-b border-gray-100 px-5 py-4">
          <div>
            <i class="fa fa-exclamation-triangle text-orange-500"></i>
            <span class="font-bold text-gray-700 text-lg">Edit Title</span>
          </div>
          <div>
            <button><i class="fa fa-times-circle text-red-500 hover:text-red-600 transition duration-150"></i></button>
          </div>
        </div>

        <div class="px-10 py-5">
         <label class="text-gray-600 font-light">Please Enter New Title</label>
         <input type='text' v-model="categoryTitle"  class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" />
         


       </div>


       <div class="px-5 py-4 flex justify-end">
        <button @click="$modal.hide('category-title')" class="bg-red-500 mr-1 rounded text-sm py-2 px-3 text-white hover:bg-red-600 transition duration-150">Cancel</button>
        <button @click="editCategory()" class="text-sm py-2 px-3 text-pink-100 bg-pink-900 hover:bg-pink-800  transition duration-150">OK</button>
      </div>
    </div>
    <!-- Card modal -->
  </modal>
  <modal name="card-modal">

    <div class=" rounded-lg shadow-lg bg-white ">
      <div class="flex justify-between border-b border-gray-100 px-5 py-3">
        <div>
          <i class="fa fa-exclamation-triangle text-orange-500"></i>
          <span class="font-bold text-gray-700 text-lg">Edit Card</span>
        </div>
        <div>
          <button><i class="fa fa-times-circle text-red-500 hover:text-red-600 transition duration-150"></i></button>
        </div>
      </div>
      
      <div class="px-10 py-3">
       <label class="text-gray-600 font-light">Please Enter New Title</label>
       <input type='text' v-model="itemTitle"  class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" />

       <label class="text-gray-600 font-light">Please Enter New Description</label>
       <textarea  v-model="itemDesctiption"  class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" ></textarea>

     </div>


     <div class="px-3 py-2 flex justify-end">

       <button @click="$modal.hide('card-modal')" class="bg-red-500 mr-1 rounded text-sm py-2 px-3 text-white hover:bg-red-600 transition duration-150">Cancel</button>
       <button @click="editItem()" class="text-sm py-2 px-3 text-pink-100 bg-pink-900 hover:bg-pink-800  transition duration-150">OK</button>
     </div>
   </div>
 </modal>
 <div class="mr-1 w-1/6 max-w-xs"> 
  <button @click="addColumn()" class="bg-red-500 mr-1 rounded text-sm py-2 px-3 text-white hover:bg-red-600 transition duration-150">Add Columns</button>
  <div class="mr-1 w-1/6 max-w-xs"> 
  <button @click="exportDB()" class="bg-red-500 mt-3   rounded text-sm py-2 px-3 text-white hover:bg-red-600 transition duration-150">Export DB</button>
</div>
</div>
<div
v-for="(category,category_index) in categories"
:key="category.id"
class="mr-6 w-4/5 max-w-xs flex-shrink-0"
>

<div class="rounded-md shadow-md overflow-hidden">
  <div class="p-3 flex justify-between items-baseline bg-pink-800 ">


    <h4 class="font-medium text-white">
      {{  category.title }}
    </h4>
    <button
    @click="deleteAll(category_index,category.id)"
    class="py-1 px-2 text-sm text-orange-400 hover:underline"
    >
    Delete
  </button>
  <button
  @click="showEditCategoryModal(category_index,category.id)"
  class="py-1 px-2 text-sm text-orange-400 hover:underline"
  >
  Edit Title
</button>
<button
@click="openAddItemForm(category.id)"
class="py-1 px-2 text-sm text-orange-400 hover:underline"
>
Add Item
</button>
</div>
<div class="p-5  bg-blue-100">
  <!-- AddItemForm -->
  <AddItemForm
  v-if="newItemForCategory === category.id"
  :category-id="category.id"
  v-on:item-added="handleItemAdded"
  v-on:item-canceled="closeAddItemForm"
  />
  <!-- ./AddItemForm -->

  <!-- Items -->
  <draggable
  class="flex-1 overflow-hidden"
  v-model="category.items"
  v-bind="itemDragOptions"
  @end="handleItemMoved"
  >
  <transition-group
  class="flex-1 flex flex-col h-full overflow-x-hidden overflow-y-auto rounded shadow-xs"
  tag="div"
  >
  <div
  v-for="(item,item_index) in category.items"
  :key="item.id"
  class="mb-3 p-4 flex flex-col bg-white rounded-md shadow transform hover:shadow-md cursor-pointer"
  >
  <span class="block mb-2 text-xl text-gray-900">
    {{ item.title }}
  </span>
  <p class="text-pink-900" @click="showEditItemModal(category_index,category.id,item_index,item.id)">
    Edit
  </p>
</div>
<!-- ./Items -->
</transition-group>
</draggable>

</div>
</div>
</div>
<!-- ./Columns -->
</div>
</template>

<script>
  import draggable from "vuedraggable";
  import AddItemForm from "./AddItemForm";

  export default {
    components: { draggable, AddItemForm },
    props: {
      initialData: Array
    },
    data() {
      return {
        categories: [],
        editCategoryField: null,
        categoryTitle: '',
        editCategoryIndex: '',
        itemDesctiption: '',
        itemTitle: '',
        editItemIndex: '',
        editItemField: null,

        newItemForCategory: 0
      };
    },
    computed: {
      itemDragOptions() {
        return {
          animation: 200,
          group: "task-list",
          dragClass: "status-drag"
        };
      }
    },
    mounted() {
    // 'clone' the categories so we don't alter the prop when making changes
    this.categories = JSON.parse(JSON.stringify(this.initialData));
    console.log(this.categories,'3333333333');
  },
  methods: {
    openAddItemForm(categoryId) {
      this.newItemForCategory = categoryId;
    },
    closeAddItemForm() {
      this.newItemForCategory = 0;
    },
    handleItemAdded(newItem) {
      // Find the index of the category where we should add the item
      

      const categoryIndex = this.categories.findIndex(
        category => category.id === newItem.category_id
        );

      if(!this.categories[categoryIndex]['items'])
      {
        this.categories[categoryIndex]['items'] = [];
      }
      
    

      // Add newly created item to our column
      this.categories[categoryIndex].items.push(newItem);

      // Reset and close the AddItemForm
      this.closeAddItemForm();
    },
    handleItemMoved(evt) {
      axios.put("/items/sync", { columns: this.categories }).catch(err => {
        console.log(err.response);
      });
    },
    deleteAll(category_index,category)
    {

      var url = '/categories/'+ category;
      axios.delete(url)
      .then(res => {

       this.categories.splice(category_index,1);
       console.log(res,'4645645645')

     })

      .catch(err => {
        console.log(err.response);
      });


    },
    showEditCategoryModal(category_index,category)
    {
      this.categoryTitle = this.categories[category_index]['title'];
      this.$modal.show('category-title')
      this.editCategoryField = category; 
      this.editCategoryIndex = category_index; 




    },
    editCategory()
    {



      var url = '/categories/'+  this.editCategoryField ;
      axios.put(url,{title : this.categoryTitle })
      .then(res => {

       this.categories[this.editCategoryIndex]['title'] = this.categoryTitle ;

       this.$modal.hide('category-title')

     })

      .catch(err => {
        console.log(err.response);
      });


    },
    showEditItemModal(category_index,category_id,item_index,item_id)
    {




      this.itemTitle = this.categories[category_index]['items'][item_index]['title'];
      this.itemDesctiption = this.categories[category_index]['items'][item_index]['description'];
     
      this.$modal.show('card-modal')
      this.editItemField = item_id; 
      this.editItemIndex = item_index; 
       this.editCategoryIndex = category_index; 




    },
    editItem()
    {

      var url = '/items/'+  this.editItemField ;
  



       axios.put(url, {
        title : this.itemTitle,
        description : this.itemDesctiption,
      
      })
       .then(res => {

       this.categories[this.editCategoryIndex]['items'][this.editItemIndex ]['title'] = this.itemTitle ;

        this.categories[this.editCategoryIndex]['items'][this.editItemIndex ]['description'] = this.itemDesctiption ;

             this.$modal.hide('card-modal')

       

     })

      .catch(err => {
        
      });



    },
    exportDB()
    {
     
       axios({

              url: '/export',
                    method: 'POST',
                    responseType: 'blob',

       })
       .then(res => {

       
          var fileURL = window.URL.createObjectURL(new Blob([res.data]));
                     var fileLink = document.createElement('a');
   
                     fileLink.href = fileURL;
                     fileLink.setAttribute('download', 'kanban.sql');
                     document.body.appendChild(fileLink);
   
                     fileLink.click();
       

     })

      .catch(err => {
        console.log(err,'3543453454');
      });
    },
    addColumn()
    {

     var orderNo = 1;

     if(this.categories.length)
     {
      orderNo = this.categories[this.categories.length - 1]['order'] + 1;
      }



       // Send new column to server
       axios
       .post("/categories", {
        title : 'Default',
        slug : 'default',
        order: orderNo


      })
       .then(res => {

          this.categories = [];
          this.categories = res.data;
          
          
        })
       .catch(err => {
          // Handle the error returned from our request
          
        });
     }
   }
 };
</script>

<style scoped>
  .status-drag {
    transition: transform 0.5s;
    transition-property: all;
  }
</style>
