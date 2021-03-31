/**
 * AutoImporting components
 * @param path
 * @returns {function(): *}
 */
const page = path => () => import(/* webpackChunkName: '' */ `./components/${path}`).then(m => m.default || m)

export const routes = [
    {
        path: '/trainings',
        name: 'Trainings',
        component: page('TrainingList'),
    },
    {
        path: '/trainings/:id',
        name: 'Show Training',
        component: page('TrainingView'),
        hidden: true
    }
]
