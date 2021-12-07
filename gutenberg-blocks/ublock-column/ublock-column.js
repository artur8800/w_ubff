/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./assets/src/js/blocks/ublock-column.js ***!
  \***********************************************/
function setBlockCustomClassName(className, blockName) {
  return blockName === 'core/quote' ? 'post__blockquote' : className;
} // Adding the filter


wp.hooks.addFilter('blocks.getBlockDefaultClassName', 'ublock/set-block-custom-class-name', setBlockCustomClassName);
/******/ })()
;
//# sourceMappingURL=ublock-column.js.map