Lionworxs.NewsItem = DS.Model.extend
  title: DS.attr('text')
  title_link: DS.attr('text')
  date: DS.attr('date')
  content: DS.attr('text')
  links: DS.attr('text')

# Fixtures
Lionworxs.NewsItem.FIXTURES = [
  id: 1
  title: "Lionworxs Re-Created in Ember!"
  date: "June 3, 2012"
  content: "Lionworxs, an ambitious application designed to streamline student teacher communication has been re-designed with the Ember javascript framework. This will drastically increase the potential of the application along with its performance."
]
