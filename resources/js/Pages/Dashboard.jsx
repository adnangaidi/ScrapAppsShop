import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import Dash from '../Components/Dash/Dash.jsx'

export default function Dashboard({ auth,all_apps,apps_scraped,apps_not_scraped,apps,categories }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            
        >
            <Head title="Dashboard" />
            <Dash all_apps={all_apps} apps_scraped={apps_scraped} apps_not_scraped={apps_not_scraped} apps={apps} categories={categories} />
        </AuthenticatedLayout>
    );
}
