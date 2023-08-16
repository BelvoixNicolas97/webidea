import domReady from '@roots/sage/client/dom-ready';
import Navigation from '@scripts/lib/nav';
import ListArticles from '@scripts/lib/listArticles';
import FormContact from '@scripts/lib/formContact';

/**
 * Application entrypoint
 */
domReady(async () => {
  let navigationElement = document.querySelectorAll(`#${Navigation.ID_ELEMENT}`);
  let listArticleElement = document.querySelectorAll(`#${ListArticles.ID_ELEMENT}`);
  let formContactElement = document.querySelectorAll(`#${FormContact.ID_ELEMENT}`);

  if (navigationElement.length > 0) {
    for (let nav of navigationElement) {
      try {
        new Navigation(nav);
      } catch (error) {
        console.error(error);
      }
    }
  }

  if (listArticleElement.length > 0) {
    for (let listArticle of listArticleElement) {
      try {
        new ListArticles(listArticle);
      } catch (error) {
        console.error(error);
      }
    }
  }

  if (formContactElement.length > 0) {
    for (let formContact of formContactElement) {
      try {
        new FormContact(formContact);
      } catch (error) {
        console.error(error);
      }
    }
  }
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
