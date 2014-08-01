// Application Settings
App = Ember.Application.create();
App.ApplicationAdapter = DS.FixtureAdapter;


// Helper modifiers
Ember.Handlebars.helper('html', function(value, options) {
  return new Handlebars.SafeString(value);
});


// Router
App.Router.map(function() {
  this.route('about');
  this.resource('news');
  this.route('contact');
  this.route('login');
  this.route('register');
});


// Routes
App.IndexRoute = Ember.Route.extend({
  actions: {
    willTransition: function(transition) {
      Ember.debug('Transitioned');
      transitionTo('login');
    }
  }
});
App.NewsRoute = Ember.Route.extend({
  model: function() {
    return this.store.find('newsItem');
  },

  setupController: function(controller, model) {
    controller.set('model', model);
  }
});


// Controllers
App.ApplicationController = Ember.Controller.extend({
  year: (function() {
      date = new Date();
      return date.getFullYear();
  }).property()
});
App.NewsController = Ember.ArrayController.extend({
  sortProperties: ['date'],
  sortAscending: true,

  contents: [],

  toggleSortText: function() {
    if(this.get('sortAscending')) {
      return "Sort Descending"
    }else {
      return "Sort Ascending"
    }

  }.property('sortAscending'),

  actions: {
    toggleSort: function() {
      if(this.get('sortAscending')) {
        this.set('sortAscending', false)
      }
      else {
        this.set('sortAscending', true)
      }
    }
  }
});

App.LoginController = Ember.ObjectController.extend({
  actions: {
    login: function(user_type) {
      Ember.debug('Logged In!');
    }
  }
});


// Views
App.ApplicationView = Ember.View.extend({
  click: function() {
    Ember.debug('Debugged');
  }
});
App.IndexView = Ember.View.extend({
  click: function() {
    Ember.debug('Debugged');
  }
});
App.AboutView = Ember.View.extend({
  click: function() {
    Ember.debug('Debugged');
  }
});
App.NewsView = Ember.View.extend({
  click: function() {
    Ember.debug('Debugged');
  }
});


// Components
