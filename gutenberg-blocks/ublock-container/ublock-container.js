!function(){"use strict";var e=wp.blocks.registerBlockType,t=wp.blockEditor.InnerBlocks;wp.blockEditor.useBlockProps,e("ublock/container",{title:"Section block",description:"Section block with with an opportunity to change className",keywords:["container","wrapper","section"],supports:{align:["wide","full"],anchor:!0,html:!1,customClassName:!0,className:!1,isertAfter:!0},category:"common",icon:"editor-kitchensink",attributes:{content:{type:"string"},exampleText:{type:"string",default:""},postIds:{type:"array",default:[]}},edit:function(e){var c=e.customClassName;return React.createElement("div",{className:c},React.createElement(t,{renderAppender:t.ButtonBlockAppender}))},save:function(e){var c=e.customClassName;return React.createElement("section",{className:c},React.createElement(t.Content,null))}})}();