<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import { useForm, Head } from '@inertiajs/inertia-vue3';
    import UserProject from '@/Components/UserProject.vue';
    //$newprojroute='/dashboard';
    
    defineProps(['projects']);
    
    const form = useForm({
        message: '',
    });
</script>
     
    <template>
        <Head title="UserProjects" />
     
        <AuthenticatedLayout>
            <div class=" mx-auto p-4 sm:p-6 lg:p-8">
                <a :href= "route('projects.create' )">
                    <PrimaryButton class="mt-4" >New Project</PrimaryButton>
                </a>
                
                
            </div>

            <div class="mx-40 bg-white shadow-md rounded-lg divide-y">
                <UserProject
                    v-for="project in projects"
                    :key="project.id"
                    :project="project"
                />
             </div>


        </AuthenticatedLayout>
    </template>