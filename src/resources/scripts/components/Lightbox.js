import baguetteBox from 'baguettebox.js';

export const Lightbox = () => {

  const init = () => {
    baguetteBox.run('.wp-block-gallery, .wp-block-image', {
      bodyClass: 'overflow-hidden'
    });
  };

  return { init };
};
