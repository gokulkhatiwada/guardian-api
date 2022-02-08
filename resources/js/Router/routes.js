import Main from "../components/Main";
import Article from "../components/Article";
import Category from "../components/Category";
import Section from "../components/Section";


const routes = [
    {
        path: '/',
        name: 'home',
        component: Main
    },
    {
        path: '/categories',
        name: 'section',
        component: Section
    },
    {
        path: '/:category',
        name: 'category',
        component: Category,

    },
    {
        path:'/:id',
        name: 'article',
        component: Article,

    }
];
export default routes;
