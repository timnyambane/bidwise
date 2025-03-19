import NewJobs from "@/Components/Layouts/Customer/NewJobs.vue";
import Quoted from "@/Components/Layouts/Customer/Quoted.vue";
import InProgress from "@/Components/Layouts/Customer/InProgress.vue";
import History from "@/Components/Layouts/Customer/History.vue";
import Inbox from "@/Components/Layouts/Customer/Inbox.vue";
import Leads from "./Components/Layouts/Business/Leads.vue";

export const jobs = [
    {
        id: 1,
        avatar: "https://randomuser.me/api/portraits/men/1.jpg",
        postedBy: "John Doe",
        title: "Frontend Developer",
        name: "Tech Corp",
        postedOn: "March 8, 2025",
        description:
            "We are looking for a skilled frontend developer with experience in Vue.js and TailwindCSS. We need a digital marketing specialist with experience in SEO and PPC campaigns.",
        service: "Web Development",
        location: "San Francisco, CA",
        urgency: "Immediate",
        job_type: "Full-Time",
        job_var: "premium",
    },
    {
        id: 2,
        avatar: "https://randomuser.me/api/portraits/women/2.jpg",
        postedBy: "Jane Smith",
        title: "Backend Engineer",
        name: "Innovate LLC",
        postedOn: "March 6, 2025",
        description:
            "Join our team as a backend engineer specializing in Laravel and Node.js.",
        service: "Software Engineering",
        location: "Remote",
        urgency: "Flexible",
        job_type: "Part-Time",
        job_var: "standard",
    },
    {
        id: 3,
        avatar: "https://randomuser.me/api/portraits/men/3.jpg",
        postedBy: "Michael Brown",
        title: "UI/UX Designer",
        name: "Creative Studio",
        postedOn: "March 5, 2025",
        description:
            "Looking for a UI/UX designer with a strong portfolio in web and mobile applications.",
        service: "Design & Creativity",
        location: "New York, NY",
        urgency: "Within a Month",
        job_type: "Freelance",
        job_var: "premium",
    },
    {
        id: 4,
        avatar: "https://randomuser.me/api/portraits/women/4.jpg",
        postedBy: "Emily White",
        title: "Digital Marketing Specialist",
        name: "Marketing Pros",
        postedOn: "March 3, 2025",
        description:
            "We need a digital marketing specialist with experience in SEO and PPC campaigns.",
        service: "Marketing & Advertising",
        location: "Remote",
        urgency: "Urgent",
        job_type: "Contract",
        job_var: "premium",
    },
    {
        id: 5,
        avatar: "https://randomuser.me/api/portraits/men/5.jpg",
        postedBy: "David Johnson",
        title: "Full Stack Developer",
        name: "NextGen Tech",
        postedOn: "March 2, 2025",
        description:
            "Seeking a full stack developer with expertise in Laravel and Vue.js.",
        service: "Software Engineering",
        location: "Austin, TX",
        urgency: "Flexible",
        job_type: "Full-Time",
        job_var: "standard",
    },
    {
        id: 6,
        avatar: "https://randomuser.me/api/portraits/women/6.jpg",
        postedBy: "Sarah Lee",
        title: "Content Writer",
        name: "Blog Masters",
        postedOn: "March 1, 2025",
        description:
            "Looking for an experienced content writer for long-term blog writing projects.",
        service: "Writing & Editing",
        location: "Remote",
        urgency: "Within Two Weeks",
        job_type: "Freelance",
        job_var: "standard",
    },
    {
        id: 7,
        avatar: "https://randomuser.me/api/portraits/men/7.jpg",
        postedBy: "Chris Martin",
        title: "Data Analyst",
        name: "Data Wizards",
        postedOn: "February 28, 2025",
        description:
            "Hiring a data analyst with experience in SQL, Python, and Tableau.",
        service: "Data Science",
        location: "Chicago, IL",
        urgency: "Immediate",
        job_type: "Contract",
        job_var: "premium",
    },
    {
        id: 8,
        avatar: "https://randomuser.me/api/portraits/women/8.jpg",
        postedBy: "Jessica Roberts",
        title: "HR Manager",
        name: "People First",
        postedOn: "February 25, 2025",
        description:
            "Seeking an HR Manager to oversee recruitment and employee relations.",
        service: "Human Resources",
        location: "New York, NY",
        urgency: "Within a Month",
        job_type: "Full-Time",
        job_var: "standard",
    },
    {
        id: 9,
        avatar: "https://randomuser.me/api/portraits/men/9.jpg",
        postedBy: "Brian Adams",
        title: "Cybersecurity Specialist",
        name: "SecureTech",
        postedOn: "February 22, 2025",
        description:
            "Seeking an experienced cybersecurity specialist for enterprise security solutions.",
        service: "Cybersecurity",
        location: "Los Angeles, CA",
        urgency: "Immediate",
        job_type: "Full-Time",
        job_var: "premium",
    },
    {
        id: 10,
        avatar: "https://randomuser.me/api/portraits/women/10.jpg",
        postedBy: "Rebecca Moore",
        title: "Business Analyst",
        name: "Enterprise Solutions",
        postedOn: "February 20, 2025",
        description:
            "Hiring a business analyst to evaluate market trends and provide insights.",
        service: "Business Consulting",
        location: "Remote",
        urgency: "Flexible",
        job_type: "Contract",
        job_var: "standard",
    },
    {
        id: 11,
        avatar: "https://randomuser.me/api/portraits/men/11.jpg",
        postedBy: "James Carter",
        title: "Project Manager",
        name: "Agile Co.",
        postedOn: "February 18, 2025",
        description:
            "Looking for a project manager with Agile and Scrum experience.",
        service: "Project Management",
        location: "Seattle, WA",
        urgency: "Within Two Weeks",
        job_type: "Full-Time",
        job_var: "premium",
    },
    {
        id: 12,
        avatar: "https://randomuser.me/api/portraits/women/12.jpg",
        postedBy: "Sophia Williams",
        title: "Social Media Manager",
        name: "BrandBoost",
        postedOn: "February 15, 2025",
        description:
            "Seeking a social media manager to grow brand engagement and online presence.",
        service: "Marketing & Advertising",
        location: "San Diego, CA",
        urgency: "Flexible",
        job_type: "Freelance",
        job_var: "standard",
    },
];

export const customerTabs = [
    {
        name: "New Jobs",
        component: NewJobs,
        icon: {
            default: "icon-park-outline:newlybuild",
            active: "icon-park-solid:newlybuild",
        },
        showMobileNav: true,
    },
    {
        name: "Quoted",
        component: Quoted,
        icon: {
            default: "bi:chat-square-quote",
            active: "bi:chat-square-quote-fill",
        },
        showMobileNav: true,
    },
    {
        name: "Progress",
        component: InProgress,
        icon: {
            default: "ri:chat-history-line",
            active: "ri:chat-history-fill",
        },
        showMobileNav: true,
    },
    {
        name: "History",
        component: History,
        icon: {
            default: "ic:outline-work-history",
            active: "ic:baseline-work-history",
        },
        showMobileNav: true,
    },
    {
        name: "Inbox",
        component: Inbox,
        icon: {
            default: "solar:chat-dots-outline",
            active: "solar:chat-dots-bold",
        },
        showMobileNav: false,
    },
];

export const businessTabs = [
    {
        name: "Leads",
        component: Leads,
        icon: {
            default: "icon-park-outline:newlybuild",
            active: "icon-park-solid:newlybuild",
        },
        showMobileNav: true,
    },
    {
        name: "Quoted",
        component: Quoted,
        icon: {
            default: "bi:chat-square-quote",
            active: "bi:chat-square-quote-fill",
        },
        showMobileNav: true,
    },
    {
        name: "Progress",
        component: InProgress,
        icon: {
            default: "tabler:clock",
            active: "tabler:clock-filled",
        },
        showMobileNav: true,
    },
    {
        name: "History",
        component: History,
        icon: {
            default: "ph:seal-check-bold",
            active: "ph:seal-check-fill",
        },
        showMobileNav: true,
    },
    {
        name: "Inbox",
        component: Inbox,
        icon: {
            default: "heroicons-solid:chat",
            active: "heroicons-outline:chat",
        },
        showMobileNav: false,
    },
];
