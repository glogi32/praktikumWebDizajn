export interface Post{
    id : number;
    title : string;
    content : string;
    createdAt : number;
    authorId : number;
    tagsIds : number[];
    comments : any[];
    featured : boolean;
    main : boolean;
    images : string[];
    roleId: number;
}