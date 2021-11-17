// const { registerBlockType } = wp.blocks;
// const { InnerBlocks } = wp.blockEditor;


// registerBlockType('awp/myfirstblock', {



//     title: 'Custom Container',

//     description: 'Provide custom container.',

//     keywords: [
//         'container',
//         'wrapper',
//         'section',
//     ],

//     supports: {
//         align: ['wide', 'full'],
//         anchor: true,
//         html: false,
//     },

//     category: 'common',

//     icon: 'editor-kitchensink',

//     attributes: {
//         content: {
//             type: 'string',
//         },
//     },

//     edit: (props) => {
//         const { className } = props;
//         console.log(props)
//         return (
//             <div className={className}>
//                 <InnerBlocks renderAppender={InnerBlocks.ButtonBlockAppender} />
//             </div>
//         );
//     },

//     save: (props) => {
//         const { className } = props;

//         return (
//             <section className={className}>
//                 <InnerBlocks.Content />
//             </section>
//         )
//     }
// });