Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'settings',
            path: '/settings',
            component: require('./components/Tool'),
        },
    ])
})
