// MODELS

// Site Front
App.NewsItem = DS.Model.extend({
  title: DS.attr('text'),
  title_link: DS.attr('text'),
  date: DS.attr('date'),
  content: DS.attr('text'),
  links: DS.attr('text')
});

// Application Level
// User
App.User = DS.Model.extend({
  name: DS.attr('string'),
  email: DS.attr('string'),
  password: DS.attr('string'),
  date_registered: DS.attr('date'),
  last_login: DS.attr('date'),
  schools: DS.hasMany('school'),
  classes_taught: DS.hasMany('class'),
  classes_enrolled: DS.hasMany('class'),
  children: DS.hasMany('user'),
  parents: DS.hasMany('user'),
  user_settings: DS.hasMany('userSettings'),
  avatar: DS.hasMany('string'),
  phone: DS.hasMany('number'),
  age: DS.hasMany('number')
});
App.UserSettings = DS.Model.extend({
  grade: DS.attr('number'),
  workload_variance: DS.hasMany('workloadVariance')
});
App.WorkloadVariance = DS.Model.extend({
  author: DS.belongsTo('user'),
  class: DS.hasMany('class'),
  weight: DS.attr('number')
});

// Main Content Structure
App.District = DS.Model.extend({
  author: DS.belongsTo('user'),
  name: DS.attr('string'),
  description: DS.attr('string'),
  administrators: DS.hasMany('user'),
  schools: DS.hasMany('school')
});
App.School = DS.Model.extend({
  author: DS.belongsTo('user'),
  name: DS.attr('string'),
  description: DS.attr('string'),
  district: DS.belongsTo('district'),
  classes: DS.hasMany('class'),
  administrators: DS.hasMany('user'),
  teachers: DS.hasMany('user'),
  parents: DS.hasMany('user'),
  students: DS.hasMany('user')
});
App.Class = DS.Model.extend({
  author: DS.belongsTo('user'),
  name: DS.attr('string'),
  description: DS.attr('string'),
  school: DS.belongsTo('school'),
  grading_system: DS.hasMany('gradingSystem'),
  administrators: DS.hasMany('user'),
  teachers: DS.hasMany('user'),
  students: DS.hasMany('user'),
  assignments: DS.hasMany('assignment'),
  active: DS.hasMany('boolean')
});
App.Assignment = DS.Model.extend({
  author: DS.belongsTo('user'),
  name: DS.attr('string'),
  description: DS.attr('string'),
  administrators: DS.hasMany('user'),
  assigned_date: DS.attr('date'),
  action_date: DS.attr('date'),
  class: DS.belongsTo('class'),
  type: DS.attr('string'),
  grading_category: DS.hasMany('gradingCategory'),
  attachments: DS.hasMany('attachment'),
  length: DS.attr('number'),
  points: DS.attr('number')
});

// Grading Structure
App.GradingSystem = DS.Model.extend({
  author: DS.belongsTo('user'),
  name: DS.attr('string'),
  description: DS.attr('string'),
  class: DS.belongsTo('class'),
  subject: DS.hasMany('subject'),
  grading_categories: DS.hasMany('gradingCategory')
});
App.Subject = DS.Model.extend({
  author: DS.belongsTo('user'),
  name: DS.attr('string'),
  description: DS.attr('string'),
  grading_system: DS.hasMany('gradingSystem')
});
App.GradingCategory = DS.Model.extend({
  author: DS.belongsTo('user'),
  name: DS.attr('string'),
  description: DS.attr('string'),
  weight: DS.attr('number')
});











// Fixtures
App.NewsItem.FIXTURES = [
  {
    id: 1,
    title: "Lionworxs Re-Created in Ember!",
    date: "June 3, 2012",
    content: "Lionworxs, an ambitious application designed to streamline student teacher communication has been re-designed with the Ember javascript framework. This will drastically increase the potential of the application along with its performance."
  }
];













//
