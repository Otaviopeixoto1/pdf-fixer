<script setup>
    import { reactive } from 'vue'
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import { useDropzone } from "vue3-dropzone";
    import { useForm, Head } from '@inertiajs/inertia-vue3';
    import axios from "axios";
    
    const url ="/projects" ;

    
    const fields = reactive({ projectTitle: 'Untitled Project' });


    const formData = new FormData();
    var lastIndex = 0; // last uploaded file's index. Resets when the page is reloaded

    const saveFiles = (files, fData) => {
        for (var x = 0; x < files.length; x++) {
            // append files as array to the form
            fData.append("file[" + (lastIndex + x) + "]" , files[x]);
            console.log(fData.get("file["+ (lastIndex + x) +"]"));
        }
        lastIndex = files.length;
    };


    const saveFields = (fData) => {

        fData.append("name" , fields.projectTitle);
    
    };

    /* post the formData to the backend where storage is processed. 
    // In the backend, to save each file, the array needs to looped through.
    */
    const sendForm = (fData) => {
        axios
            .post(url, fData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
            })
            .then((response) => {
                //console.info(response.data);
                console.log(response.data);
            })
            .catch((err) => {
                //console.error(err);
            });

            //should have a return in case of failure
    };


    const clearForm = (fData) => {
        for (var key of fData.keys()) {
            
            fData.delete(key);
        };
    };




    function onDrop(acceptFiles, rejectReasons) {
        saveFiles(acceptFiles,formData);
        //console.log(acceptFiles);
        console.log("reject reasons: "+ rejectReasons);
    }

    function onSubmit() {
        saveFields(formData);
        //console.log(formData.get("name"));
        sendForm(formData); // do something in case of failure
        clearForm(formData);


    }

            
    const { getRootProps, getInputProps, ...rest } = useDropzone({ onDrop });

    
</script>
     
    <template>
        <Head title="UserProjects" />
     
        <AuthenticatedLayout>
            <div class=" mx-auto py-4 px-40 lg:py-8 lg:px-80">
                <div class="pb-4">
                    <font size="+1">
                        Title: 
                    </font>
                    <input type="text" v-model.lazy="fields.projectTitle" @focus="$event.target.select()" />

                </div>


                <div v-bind="getRootProps()">
                    <label for="dropzone-file" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col justify-center items-center pt-5 pb-6">
                            <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input v-bind="getInputProps()" />
                    </label>
                    <!-- 
                    <p v-if="isDragActive">Drop the files here ...</p>
                    <p v-else>Drag 'n' drop some files here, or click to select files</p>
                    -->

                </div>
                <PrimaryButton class="mt-4" @click="onSubmit">Submit</PrimaryButton>
            </div>
        </AuthenticatedLayout>
    </template>
