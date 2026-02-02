import { createRouter, createWebHistory } from "vue-router";
import FarmerList from "../pages/farmers/FarmerList.vue";
import Dashboard from "../pages/dashboard/Dashboard.vue";
import RoleList from "../pages/role/RoleList.vue";
import CreateRole from "../pages/role/CreateRole.vue";
import CreateFarmer from "../pages/farmers/CreateFarmer.vue";
import EditFarmer from "../pages/farmers/EditFarmer.vue";

const routes=[
    {path: '/farmers', name: 'FarmerList', component: FarmerList},
    {path: '/farmers/create', name: 'CreateFarmer', component: CreateFarmer},
    {path: '/farmers/edit/:id', name: 'EditFarmer', component: EditFarmer},

    {path: '/', name: 'dashboard', component: Dashboard},
    { path: '/role', name: 'RoleList', component: RoleList},
    {path: '/role/create', name: 'CreateRole', component: CreateRole},

]

export const router= createRouter({
    routes,
    history: createWebHistory()
})