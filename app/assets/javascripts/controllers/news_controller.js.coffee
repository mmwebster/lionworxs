Lionworxs.NewsController = Ember.ArrayController.extend
  sortProperties: ['date']
  sortAscending: true

  contents: []

  toggleSortText: (->
    if @get 'sortAscending'
      "Sort Descending"
    else
      "Sort Ascending"

  ).property 'sortAscending'

  actions:
    toggleSort: ->
      if @get 'sortAscending'
        @set'sortAscending', false

      else
        @set 'sortAscending', true
