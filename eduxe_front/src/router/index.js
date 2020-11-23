import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import CadEmpresa from '../views/Empresa/CadEmpresa'
import CadUnidade from '../views/Unidade/CadUnidade'
import ListarEmpresa from '../views/Empresa/ListarEmpresa'
import ListarUnidade from '../views/Unidade/ListarUnidade'
import InfoEmpresa from '../views/Empresa/InfoEmpresa'
import InfoUnidade from '../views/Unidade/InfoUnidade'
import EditarEmpresa from '../views/Empresa/EditarEmpresa'
import EditarUnidade from '../views/Unidade/EditarUnidade'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/cadastrar-empresa',
    name: 'CadEmpresa',
    component: CadEmpresa
  },
  {
    path: '/cadastrar-unidade',
    name: 'CadUnidade',
    component: CadUnidade
  },
  {
    path: '/listar-empresas',
    name: 'ListarEmpresa',
    component: ListarEmpresa
  },
  {
    path: '/listar-unidades',
    name: 'ListarUnidade',
    component: ListarUnidade
  },
  {
    path: '/info-empresa/:id',
    name: 'InfoEmpresa',
    component: InfoEmpresa,
    props: true
  },
  {
    path: '/info-unidade/:id',
    name: 'InfoUnidade',
    component: InfoUnidade,
    props: true
  },
  {
    path: '/editar-unidade/:id',
    name: 'EditarUnidade',
    component: EditarUnidade,
    props: true
  },
  {
    path: '/editar-empresa/:id',
    name: 'EditarEmpresa',
    component: EditarEmpresa,
    props: true
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
