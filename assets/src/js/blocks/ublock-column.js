function setBlockCustomClassName(className, blockName) {
    return blockName === 'core/quote' ? 'post__blockquote' : className;
}

// Adding the filter
wp.hooks.addFilter(
    'blocks.getBlockDefaultClassName',
    'ublock/set-block-custom-class-name',
    setBlockCustomClassName
);