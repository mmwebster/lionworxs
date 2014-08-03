Lionworxs.ApplicationRoute = Ember.Route.extend
  actions:
    willTransition: (transition)->
      Ember.debug('Application Transition.')
