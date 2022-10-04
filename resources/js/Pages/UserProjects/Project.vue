<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    defineProps(['project_id','project_name']);
</script>
     
<template>
    <Head :title="project_name" />
     
    <AuthenticatedLayout>
       <p> {{project_id}} </p>
       <p> {{project_name}} </p>
    </AuthenticatedLayout>
</template>