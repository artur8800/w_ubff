const { registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.blockEditor;


import '../../sass/gutenberg-block-styles/ublock-section.scss';


registerBlockType('ublock/section', {



    title: 'Section block',

    description: 'Section block with with an opportunity to change className',

    keywords: [
        'container',
        'wrapper',
        'section',
    ],

    supports: {
        align: ['wide', 'full'],
        anchor: true,
        html: false,
        customClassName: true,
        className: false,
        isertAfter: true
    },

    category: 'common',

    icon: 'editor-kitchensink',

    attributes: {
        postIds: {
            type: 'array',
            default: []
        }
    },

    edit: (props) => {
        const { customClassName } = props;

        return (
            <div className={customClassName}>
                <InnerBlocks renderAppender={InnerBlocks.ButtonBlockAppender} />
            </div>
        );
    },

    save: (props) => {
        const { customClassName } = props;

        return (

            <section className={customClassName}>
                <InnerBlocks.Content />
            </section>
        )
    }
});