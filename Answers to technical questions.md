

## 1. How long did you spend on the coding test? What would you add to your solution if you had more time?

I received the assignment yesterday and spent around 10–12 hours working on it over the last two days. Although I had four days to complete it, I wanted to finish it early so I could focus on refining the UI and ensuring it closely matched the provided design across both desktop and mobile devices.

If I had additional time, I would enhance the project with a few extra features:

* Implement JWT-based authentication to secure the admin panel.
* Store uploaded images in AWS S3 instead of the local file system for better scalability and reliability.
* Add drag-and-drop functionality so administrators can easily reorder slides.
* Perform load and performance testing to evaluate how the application behaves under higher traffic conditions and optimize it further if needed.

---

## 2. How would you track down a performance issue in production? Have you ever had to do this?

Yes, I have worked on production performance issues before. In one of my previous projects, I helped reduce API response times significantly by identifying and optimizing bottlenecks.

My usual approach is:

1. First, I identify where the slowdown is occurring—whether it's the frontend, backend, or database. Monitoring tools and application logs are very helpful at this stage.

2. If the issue is related to MongoDB, I analyze slow queries, review indexes, and use query execution plans to identify optimization opportunities.

3. If the backend is the bottleneck, I review the API logic, database calls, and external service integrations. In many cases, optimizing queries or introducing caching can greatly improve performance.

4. If the API is performing well but the application still feels slow, I inspect the frontend using browser developer tools and Lighthouse to identify issues such as large assets, unnecessary re-renders, or render-blocking resources.

After implementing improvements, I verify the results in a testing environment before deploying the changes to production and monitoring the impact to ensure the issue has been resolved successfully.


### 3. Please describe yourself using JSON.

```json
{
  "name": "Vijayakumar.S",
  "title": "Full Stack MERN React Developer",
  "experience": "2+ Years",
  "passion": "Building scalable, real-time web applications and microservices architecture",
  "core_competencies": {
    "frontend": ["React.js", "JavaScript (ES6)", "HTML5", "CSS3", "Tailwind CSS", "Bootstrap", "jQuery"],
    "backend": ["Node.js", "Express.js", "PHP", "MySQL", "REST APIs"],
    "database_and_cache": ["MongoDB", "Redis"],
    "cloud_and_tools": ["AWS (EC2, S3, AppSync, SES, SNS)", "Azure Blob Storage", "Git", "Postman"]
  },
  "specialties": [
    "Real-Time WebSockets (Socket.io)",
    "Performance Optimization",
    "Live Commerce Platforms",
    "Payment Gateway Integrations"
  ],
  "traits": [
    "Analytical problem solver",
    "Continuous learner",
    "Performance-focused"
  ],
  "ready_to_join": true
}
```
