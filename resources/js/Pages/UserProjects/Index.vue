<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import { useForm, Head } from '@inertiajs/inertia-vue3';
    
    //$newprojroute='/dashboard';
    

    
    const form = useForm({
        message: '',
    });
</script>
     
    <template>
        <Head title="UserProjects" />
     
        <AuthenticatedLayout>
            <div class=" mx-auto p-4 sm:p-6 lg:p-8">
                <a :href= "route('projects.create')">
                    <PrimaryButton class="mt-4" >New Project</PrimaryButton>
                </a>
            </div>
        </AuthenticatedLayout>
    </template>