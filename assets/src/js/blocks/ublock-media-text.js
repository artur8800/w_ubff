const { registerBlockType } = wp.blocks;
const { InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps, RichText, SelectControl } = wp.blockEditor;
const { PanelBody, Button, ResponsiveWrapper } = wp.components;
const { Fragmentn, useState } = wp.element;
const { withSelect } = wp.data;
const { __ } = wp.i18n;


const BlockEdit = (props) => {
    const { attributes, setAttributes } = props;


    const removeMedia = () => {
        props.setAttributes({
            mediaId: 0,
            mediaUrl: ''
        });
    }

    const onSelectMedia = (media) => {
        props.setAttributes({
            mediaId: media.id,
            mediaUrl: media.url
        });
    }

    const onSelectOption = (selection) => {
        props.setAttributes({
            item: selection
        })
    }

    const blockStyle = {
        backgroundImage: attributes.mediaUrl != '' ? 'url("' + attributes.mediaUrl + '")' : 'none'
    };

    return (


        <div className="editor-post-featured-image">


            <div className="leftCol">

                <MediaUploadCheck>
                    <MediaUpload
                        onSelect={onSelectMedia}
                        value={attributes.mediaId}
                        allowedTypes={['image']}
                        render={({ open }) => (
                            <Button
                                className={attributes.mediaId == 0 ? 'editor-post-featured-image__toggle' : 'editor-post-featured-image__preview'}
                                onClick={open}
                            >
                                {attributes.mediaId == 0 && __('Choose an image', 'awp')}
                                {props.media != undefined &&
                                    <ResponsiveWrapper
                                        naturalWidth={600}
                                        naturalHeight={600}
                                    >
                                        <img src={props.media.source_url} />
                                    </ResponsiveWrapper>
                                }
                            </Button>
                        )}
                    />
                </MediaUploadCheck>
                <div className="controls">
                    {attributes.mediaId != 0 &&
                        <MediaUploadCheck>
                            <MediaUpload
                                title={__('Replace image', 'awp')}
                                value={attributes.mediaId}
                                onSelect={onSelectMedia}
                                allowedTypes={['image']}
                                render={({ open }) => (
                                    <Button onClick={open} isDefault>{__('Replace image', 'awp')}</Button>
                                )}
                            />
                        </MediaUploadCheck>
                    }
                    {attributes.mediaId != 0 &&
                        <MediaUploadCheck>
                            <Button onClick={removeMedia} isLink isDestructive>{__('Remove image', 'awp')}</Button>
                        </MediaUploadCheck>
                    }
                </div>
            </div>
            <div className="rightCol">
                <RichText
                    tagName="p" // The tag here is the element output and editable in the admin
                    value={attributes.content} // Any existing content, either from the database or an attribute default
                    allowedFormats={['core/bold', 'core/italic']} // Allow the content to be made bold or italic, but do not allow other formatting options
                    onChange={(content) => setAttributes({ content })} // Store updated content as a block attribute
                    placeholder={__('Your text...')} // Display this text before any content has been added by the user
                />
            </div>
        </div>

    );
};


registerBlockType('ublock/media-text', {
    title: 'AWP Imageselect',
    icon: 'smiley',
    category: 'layout',
    supports: {
        align: true,
        fontSize: true,
        defaultStylePicker: false,
    },
    attributes: {
        mediaId: {
            type: 'number',
            default: 0
        },
        mediaUrl: {
            type: 'string',
            default: ''
        },
        content: {
            type: 'string',
            source: 'html',
            selector: 'h2',
        },
        item: {
            type: 'string',
            default: ''
        },
        fontSize: {
            type: 'string',
            default: 'some-value',
        }
    },
    edit: withSelect((select, props) => {
        return { media: props.attributes.mediaId ? select('core').getMedia(props.attributes.mediaId) : undefined };
    })(BlockEdit),
    save: (props) => {
        const { attributes } = props;
        const blockProps = useBlockProps.save();
        return (
            <div>
                <div>
                    <img className="the-image" src={attributes.mediaURL} />
                </div>
                <RichText.Content {...blockProps} tagName="h2" value={attributes.content} />;
            </div>
        );
    }
});