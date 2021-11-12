const { registerBlockType } = wp.blocks;


registerBlockType('awp/myfirstblock', {
    title: 'My first block',
    category: 'common',
    icon: 'smiley',
    description: 'Learning in progress',
    keywords: ['example', 'test'],
    edit: () => {
        return <div>:)</div>
    },
    save: () => {
        return <div>:)</div>
    }
});